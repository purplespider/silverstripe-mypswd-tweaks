# Purple Spider Web Design Custom SilverStripe Tweaks

## Introduction

This module contains many of the custom tweaks that I make to every SilverStripe site I do. A lot is just hiding features that most of my clients don't use to clean up the CMS interface.

While it is possible to disable specific tweaks by removing the individual extension, **you probably don't want to use this module as is**. Partly because it automatically sets the SilverStripe Help link to my custom help site. However, please do take a look around and steal anything you may find useful!

## Maintainer Contact ##
 * James Cocker (ssmodulesgithub@pswd.biz)
 
## Requirements
 * Silverstripe 4.1+
 * For SilverStripe 3 related tweaks, see the 1.0 branch.

## Active Extensions
* __AllowFileUploads:__ Enabled file uploads for all CMS users. (sets canCreate etc to true)
* __PageHideDependent:__ Hides the "Dependent" page CMS tab.
* __PageHideExtraMetaData:__ Hides MetaKeywords and ExtraMeta fields.
* __PageSettingsHidePermissions:__ Hides Page permission fields such as CanViewType and CanEditType.
* __PageSettingsHideSearch:__ Hides the ShowInSearch settings field.
* __MemberTidy:__ Hides ofen unused Member fields such as Time & Date format.
* __CMSMenuLinks && CustomSiteConfig:__ Adds admin customisable CMS links to my custom help guide and analytics
* __LoginSessionExtension:__ Required for `Recent Active Users` report (see below)

## Extra Extensions
* __CannotCreatePage:__ Apply this extension to page types that you don't want non-admin users to be able to create.
* __BlockPageDelete:__ Disables ability to Archive or Unpublish a page that extends this. Applied to HomePage by default.
* __SinglePageOnly:__ Can to applied to any page type, so only 1 can be created. Useful for keeping the Add New page type list tidy.


## Page Types
* __FirstChildRedirect:__ Automatically redirects to the first child of the page. Useful for top level pages with no content of their own.


## Config
* __E-mail Error Log Alerts:__ logging.yml e-mails any error that occurs on a 'live' site.
* __CMS Help Link:__ Sets the CMS help link to my custom built SilverStripe Help site.
* __Hide Error Page:__ Hides Error Page from the Add New page list (uses CannotCreatePage extension)
* __Hide Virtual Page:__ Hides Virtual Page from the Add New page list (uses CannotCreatePage extension)
* __Set Admin Email:__ Set's the Admin Email address to a noreply address for which I control the SPF. Better than no address at all, which can result in forgotten password e-mails flagged as spam.
* __Disable TinyMCE Icons:__ Disables some icons such as underline.
* __Enable TinyMCE Styles:__ Enables the Styles dropdown for custom styles.


## CMS CSS
* __Hides Error Pages:__ Hides error pages from the site tree.
* __Differentiate Hidden Pages:__ Pages that have "Show in menus?" unchecked, are grey in the site tree.
* __Hide Disabled Pages from Add New:__ Pages that can't be created are now hidden from the Add page list, rather than being greyed out.
* __Hide GridField Pagination Details:__ From above a GridField only, to avoid the gap below the GridField title.
* __GridField: Vertical Align Middle:__ Set cells of GridField to vertical align middle. Looks nicer, especially with centered icons and drag handles.

## Templates
* __Email.ss:__ Sets font to sans-serif
* __ForgotPasswordEmail.ss:__ Changes the wording and format of the forgotten password e-mail to make it a bit friendlier. 
* __SiteTreeURLSegmentField.ss:__ Adds a "Copy URL" button. To help stop users from copying the draft link.

## Modules
* __[wilr/silverstripe-googlesitemaps](https://github.com/wilr/silverstripe-googlesitemaps):__ Lets CMS users set certain (e.g. hidden) pages to not be indexed.
* __[jonom/silverstripe-betternavigator](https://github.com/jonom/silverstripe-betternavigator):__ Added frontend flag for Draft/Live and shortcuts.
* __[axllent/silverstripe-email-obfuscator](https://github.com/axllent/silverstripe-email-obfuscator):__ Automatically obfucates email addresses added in HTMLText fields/templates.
* __[kinglozzer/metatitle](https://github.com/kinglozzer/silverstripe-metatitle):__ Adds editable metatitle field for each page.

## Tasks
* __Generate CMS Thumbnails:__ A task to run generateThumbnails() on each File object. For use after the MigrateFileTask if using `legacy_filenames`
* __Send Test Email:__ A task to instantly send a test email to quickly check email deliverability.

## Reports
* __Recent Active Users:__ Displays a list of users who have recently logged in. Useful for quickly checking that no CMS users are logged in, before performing maintenance. Modified [/silverstripe/silverstripe-securityreport](https://github.com/silverstripe/silverstripe-securityreport).


## Lang
* __Renames User Defined Form:__ To a more user friendly "Form Page".
