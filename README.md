# Purple Spider Web Design Custom SilverStripe Tweaks

## Introduction

This module contains many of the custom tweaks that I make to every SilverStripe site I do. A lot is just hiding features that most of my clients don't use to clean up the CMS interface.

While it is possible to disable specific tweaks by removing the individual extension, **you probably don't want to use this module as is**. Partly because it automatically sets the SilverStripe Help link to my custom help site. However, please do take a look around and steal anything you may find useful!

## Maintainer Contact

-   James Cocker (ssmodulesgithub@pswd.biz)

## Requirements

-   Silverstripe 6.0+
-   For SilverStripe 5 related tweaks, see the 6.3.0 tag or earlier.
-   For SilverStripe 4 related tweaks, see the 5.x branch.
-   For SilverStripe 3 related tweaks, see the 1.0 branch.

## Active Extensions

-   **AllowFileUploads:** Enabled file uploads (in Files tab) for all CMS users. (sets canCreate etc to true)
-   **PageHideDependent:** Hides the "Dependent" page CMS tab.
-   **PageHideExtraMetaData:** Hides MetaKeywords and ExtraMeta fields.
-   **PageSettingsHidePermissions:** Hides Page permission fields such as CanViewType and CanEditType.
-   **PageSettingsHideSearch:** Hides the ShowInSearch settings field.
-   **MemberTidy:** Hides ofen unused Member fields such as Time & Date format.
-   **CMSMenuLinks && CustomSiteConfig:** Adds admin customisable CMS links to my custom help guide and analytics
-   **LoginSessionExtension:** Required for `Recent Active Users` report (see below)

## Extra Extensions

-   **CannotCreatePage:** Apply this extension to page types that you don't want non-admin users to be able to create.
-   **BlockPageArchive:** Disables ability to Archive or Unpublish a page that extends this. Useful for protecting important pages such as the homepage.
-   **SinglePageOnly:** Can be applied to any page type, so only 1 can be created. Useful for keeping the Add New page type list tidy.

These are not applied by the module, as the page class names differ per project. Apply them in the project's own YAML config, for example:

```yaml
MyProject\MySite\HomePage:
  extensions:
    - PurpleSpider\SSTweaks\SinglePageOnly
    - PurpleSpider\SSTweaks\BlockPageArchive
```

## Page Types

-   **FirstChildRedirect:** Automatically redirects to the first child of the page. Useful for top level pages with no content of their own.

## Config

-   **E-mail Error Log Alerts:** logging.yml e-mails any error that occurs on a 'live' site.
-   **CMS Help Link:** Sets the CMS help link to my custom built SilverStripe Help site.
-   **Hide Error Page:** Hides Error Page from the Add New page list (uses CannotCreatePage extension)
-   **Hide Virtual Page:** Hides Virtual Page from the Add New page list (uses CannotCreatePage extension)
-   **Set Admin Email:** Set's the Admin Email address to a noreply address for which I control the SPF. Better than no address at all, which can result in forgotten password e-mails flagged as spam.
-   **Disable TinyMCE Icons:** Disables some icons such as underline.
-   **Enable TinyMCE Styles:** Enables the Styles dropdown for custom styles.
-   **Disable TinyMCE Table Appearance Options:** Disables table cell spacing, cell padding, border, and caption fields in table dialogs.
-   **Disable TinyMCE Table Advanced Tabs:** Hides the Advanced tab in Cell and Row properties dialogs, removing border color and background color options.

## CMS CSS

-   **Hides Error Pages:** Hides error pages from the site tree.
-   **Differentiate Hidden Pages:** Pages that have "Show in menus?" unchecked, are grey in the site tree.
-   **Hide Disabled Pages from Add New:** Pages that can't be created are now hidden from the Add page list, rather than being greyed out.
-   **Hide GridField Pagination Details:** From above a GridField only, to avoid the gap below the GridField title.
-   **GridField: Vertical Align Middle:** Set cells of GridField to vertical align middle. Looks nicer, especially with centered icons and drag handles.
-   **Fix SS6 Button Wrapping:** Fixes wrapping of "Batch actions" button by changing "Add new page" to "Add page" and reducing margin.

## Templates

-   **ForgotPasswordEmail.ss:** Changes the wording and format of the forgotten password e-mail to make it a bit friendlier.
-   **SiteTreeURLSegmentField.ss:** Adds a "Copy URL" button. To help stop users from copying the draft link.

## Modules

-   **[wilr/silverstripe-googlesitemaps](https://github.com/wilr/silverstripe-googlesitemaps):** Lets CMS users set certain (e.g. hidden) pages to not be indexed.
-   **[jonom/silverstripe-betternavigator](https://github.com/jonom/silverstripe-betternavigator):** Added frontend flag for Draft/Live and shortcuts.
-   **[axllent/silverstripe-email-obfuscator](https://github.com/axllent/silverstripe-email-obfuscator):** Automatically obfucates email addresses added in HTMLText fields/templates.
-   **[kinglozzer/metatitle](https://github.com/kinglozzer/silverstripe-metatitle):** Adds editable metatitle field for each page.
-   **[purplespider/silverstripe-assets-cachebusting](https://github.com/purplespider/silverstripe-assets-cachebusting):** Automatically adds cache-busting query strings to asset URLs to fix Cloudflare caching issues.

## Tasks

-   **Generate CMS Thumbnails:** A task to run generateThumbnails() on each File object. For use after the MigrateFileTask if using `legacy_filenames`
-   **Send Test Email:** A task to instantly send a test email to quickly check email deliverability.

## Reports

-   **Recent Active Users:** Displays a list of users who have recently logged in. Useful for quickly checking that no CMS users are logged in, before performing maintenance. Modified [/silverstripe/silverstripe-securityreport](https://github.com/silverstripe/silverstripe-securityreport).

## Lang

-   **Renames User Defined Form:** To a more user friendly "Form Page".
