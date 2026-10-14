<?php

namespace PurpleSpider;

use SilverStripe\ORM\DataList;
use SilverStripe\Reports\Report;
use SilverStripe\Forms\FormField;
use SilverStripe\Security\Member;
use SilverStripe\Control\Director;
use SilverStripe\Security\Security;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\SessionManager\Models\LoginSession;
use SilverStripe\Forms\GridField\GridFieldPrintButton;
use SilverStripe\Forms\GridField\GridFieldExportButton;
use SilverStripe\SecurityReport\Forms\GridFieldPrintReportButton;
use SilverStripe\SecurityReport\Forms\GridFieldExportReportButton;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\View\Requirements;
use SilverStripe\ORM\FieldType\DBDatetime;

class RecentLoginsReport extends Report
{

    /**
     * Columns in the report
     *
     * @var array
     * @config
     */
    private static $columns = array(
        // 'ID' => 'User ID',
        // 'LastLoggedIn' => 'Last Logged In',
        'LastAccessed.Ago' => 'Last Activity',
        'Member.FirstName' => 'First Name',
        'Member.Surname' => 'Surname',
        'Member.Email' => 'Email',
        'Member.Created' => 'Date Created',
        'LastAccessed' => 'Last Activity',
    );

    protected $dataClass = Member::class;

    /**
     * Returns the report title
     *
     * @return string
     */
    public function title()
    {
        return 'Recent Active Users';
    }

    /**
     * Builds a report description which is the current hostname with the current date and time
     *
     * @return string e.g. localhost/sitename - 21/12/2112
     */
    public function description()
    {
        return str_replace(
            array('http://', 'https://'),
            '',
            Director::protocolAndHost() . ' - ' . date('d/m/Y H:i:s')
        );
    }

    /**
     * Returns the column names of the report
     *
     * @return array
     */
    public function columns()
    {
        $columns = self::config()->columns;
        // if (!Security::config()->get('login_recording')) {
        //     unset($columns['LastLoggedIn']);
        // }
        return $columns;
    }

    /**
     * Alias of columns(), to support the export to csv action
     * in {@link GridFieldExportButton} generateExportFileData method.
     * @return array
     */
    public function getColumns()
    {
        return $this->columns();
    }

    /**
     * @return array
     */
    public function summaryFields()
    {
        return $this->columns();
    }

    /**
     * Defines the sortable columns on the report gridfield
     *
     * @return array
     */
    public function sortColumns()
    {
        return array_keys($this->columns());
    }

    /**
     * Get the source records for the report gridfield
     *
     * @return DataList
     */
    public function sourceRecords()
    {
        // Get members sorted by ID
        return LoginSession::get()->sort('LastAccessed DESC');
    }

    /**
     * Restrict access to this report to users with security admin access
     *
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null)
    {
        return (bool)Permission::checkMember($member, "CMS_ACCESS_SecurityAdmin");
    }

    /**
     * Return a field, such as a {@link GridField} that is
     * used to show and manipulate data relating to this report.
     *
     * @return FormField subclass
     */
    public function getReportField()
    {
        /** @var GridField $gridField */
        $gridField = parent::getReportField();
        $gridField->setModelClass(self::class);
        $gridConfig = $gridField->getConfig();
        $gridConfig->removeComponentsByType([GridFieldPrintButton::class, GridFieldExportButton::class]);
        
        // Add custom class to identify this specific grid
        $gridField->addExtraClass('recent-logins-report');
        
        return $gridField;
    }
    
    /**
     * Called when the report is being viewed - ensures CSS/JS is always loaded
     */
    public function __construct()
    {
        parent::__construct();
        
        // Always include CSS for styling
        Requirements::css('purplespider/mypswd-tweaks: client/dist/cms-tweaks.css');
        
        // Add JavaScript to handle row styling
        $currentUser = Security::getCurrentUser();
        $currentUserEmail = $currentUser ? $currentUser->Email : '';
        
        Requirements::customScript("
        (function() {
            function applyRowStyling() {
                var grid = document.querySelector('.recent-logins-report');
                if (!grid) return;
                
                var rows = grid.querySelectorAll('tbody tr');
                var currentUserEmail = '" . addslashes($currentUserEmail) . "';
                
                rows.forEach(function(row) {
                    var cells = row.querySelectorAll('td');
                    if (cells.length < 4) return;
                    
                    var activityAgoCell = cells[0]; // 'Last Activity' (ago format)
                    var emailCell = cells[3];       // 'Email'
                    
                    if (!activityAgoCell || !emailCell) return;
                    
                    var email = emailCell.textContent.trim();
                    var activityAgo = activityAgoCell.textContent.trim();
                    
                    var isCurrentUser = currentUserEmail && email === currentUserEmail;
                    
                    // Check if this is the current user
                    if (isCurrentUser) {
                        row.classList.add('current-user');
                    }
                    
                    // Check if activity was within last 5 minutes (but NOT for current user)
                    if (!isCurrentUser) {
                        console.log('Activity text:', activityAgo); // Debug log
                        
                        var isRecentActivity = false;
                        
                        // Check for seconds
                        if (activityAgo.includes('second') || activityAgo.includes('secs')) {
                            isRecentActivity = true;
                        }
                        // Check for minutes (1-5 minutes) - handle both 'mins' and 'minute'
                        else if (activityAgo.includes('min')) {
                            var minuteMatch = activityAgo.match(/(\\d+)\\s*mins?\\s*ago/);
                            if (minuteMatch) {
                                var minutes = parseInt(minuteMatch[1]);
                                console.log('Parsed minutes:', minutes); // Debug log
                                if (minutes <= 5) {
                                    isRecentActivity = true;
                                }
                            }
                        }
                        
                        if (isRecentActivity) {
                            row.classList.add('recent-activity');
                            console.log('Added recent-activity class to row'); // Debug log
                        }
                    }
                });
            }
            
            // Apply immediately if DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', applyRowStyling);
            } else {
                applyRowStyling();
            }
            
            // Multiple event handlers to catch different scenarios
            if (window.jQuery) {
                // AJAX requests
                jQuery(document).on('ajaxComplete', function() {
                    setTimeout(applyRowStyling, 100);
                });
                
                // History navigation (back/forward buttons)
                jQuery(window).on('popstate', function() {
                    setTimeout(applyRowStyling, 200);
                });
                
                // CMS navigation
                jQuery(document).on('afterStateChange', function() {
                    setTimeout(applyRowStyling, 200);
                });
                
                // GridField reloads
                jQuery(document).on('gridfield.reload', function() {
                    setTimeout(applyRowStyling, 100);
                });
            }
            
            // Use MutationObserver to watch for DOM changes
            if (window.MutationObserver) {
                var observer = new MutationObserver(function(mutations) {
                    var shouldReapply = false;
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'childList' && 
                            mutation.target.closest && 
                            mutation.target.closest('.recent-logins-report')) {
                            shouldReapply = true;
                        }
                    });
                    if (shouldReapply) {
                        setTimeout(applyRowStyling, 50);
                    }
                });
                
                // Start observing changes to the document
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            }
        })();
        ");
    }
}
