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
        return $gridField;
    }
}
