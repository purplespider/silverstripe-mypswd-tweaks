# Purple Spider Web Design Custom SilverStripe Tweaks

## Introduction

This module contains many of the custom tweaks that I make to every SilverStripe site I do.

While it is possible to disable specific tweaks by removing the individual extension, **you probably don't want to use this module as is**. Partly becase it automatically sets the SilverStripe Help link to my custom help site. However, please do take a look around and steal anything you may find useful!

## Maintainer Contact ##
 * James Cocker (ssmodulesgithub@pswd.biz)
 
## Requirements
 * Silverstripe 3.1+

## Extensions

* __CMSHelpLink:__ Sets the CMS help link to my custom built SilverStripe Help site.
* __HideErrorPage:__ Hides error pages from the Add New page list.
* __HideUserDefinedForm:__ Hides UserDefinedForm from the Add New page list.
* __HideVirtualPage:__ Hides the VirtualPage type from the Add New page list.
* __ImageAlignmentDefaults:__ Reverts the default aligment of an inserted image back to "On the left, with text wrapping around".
* __ImageFunctions:__ Provides extra Image functions such as setMaxWidth & setMaxHeight.
* __MemberTidy:__ Hides ofen unused Member fields such as Time & Date format.
* __PageHideExtraMetaData:__ Hides MetaKeywords and ExtraMeta fields.
* __PageSettingsHidePermissions:__ Hides Page permission fields such as CanViewType and CanEditType
* __PageSettingsHideSearch:__ Hides the ShowInSearch settings field.
* __SinglePageOnly:__ Can to applied to a page type, so only 1 can be created. Useful for keeping the Add New page type list tidy.
* __CannotCreatePage:__ Apply this extension to page types that you don't want non-admin users to be able to create.
* __StaticPublisherUpdateHomepage:__ Updates the cache of the Homepage upon write (requires StaticPublisher module)
* __StaticPublisherUpdateAll:__ Updates full pages cache upon write (requires StaticPublisher module)
* __BlockPageDelete:__ Disables ability to delete a page that extends this. Applied to HomePage by default.

## Page Types

* __FirstChildRedirect:__ Automatically redirects to the first child of the page. Useful for top level pages with no content of their own.

## Tasks

* __CheckAllTemplates:__ Copy of [Nicolaas Francken's CheckAllTemplates script](https://github.com/sunnysideup/silverstripe-templateoverview/blob/master/code/tasks/CheckAllTemplates.php) for testing all tempalates/page types.

## Config

* __Default Paste as Plain Text:__ Makes Past as Plain text in TinyMCE turned on by default. Useful to avoid all those stray tags caused by clients pasting from Word.
* __Disable TinyMCE Icons:__ Disables useless icons such as underline, and broken Spell Checker.
* __Simple HTMLEditor Config:__ For use with [nathancox/customhtmleditorfield](https://github.com/nathancox/silverstripe-customhtmleditorfield). Lets you assign a simplified set of icons to certain WYSIWYG fields.
* __Custom [Better Buttons](https://github.com/unclecheese/silverstripe-gridfield-betterbuttons) Config File:__ With "Save & Close" and "Save & Add" buttons for Create, and "Save & Close" and "Save & Next" for Edit.
* __Set Admin Email:__ Set's the Admin Email address to a noreply address for the current domain. Better than no address at all, which can result in forgotten password e-mails flagged as spam.

## CMS CSS

* __Hides Error Pages:__ Hides error pages from the site tree.
* __Differentiate Hidden Pages:__ Pages that have "Show in menus?" unchecked, are grey in the site tree.
* __Dashboard Color Tweak:__ Tweaks the background colour of widgets in [Unclecheese's Dashboard module](https://github.com/unclecheese/silverstripe-dashboard), to match rest of CMS color scheme better. 
* __UploadField Alignment Tweak:__ Aligns UploadFields to the right of their label, instead of below it, to match nearly all other field types!
* __Hide Disabled Pages from Add New:__ Pages that can't be created are now hidden from the Add page list, rather than being greyed out.
* __Align HTMLEditorFields with Standard Fields:__ Allows you to align select HTMLEditorFields with standard fields, rather than them always being full width. Simply add ->addExtraClass('nofullwidth')
* __Misc SS 3.3 Tweaks:__ Some minor tweaks to improve on the drastic CMS adjustments in SilverStripe 3.3

## Templates
* __ForgotPasswordEmail.ss:__ Changes the wording and format of the forgotten password e-mail to make it a bit friendlier. 
* __GenericEmail.ss:__ Sets font to sans-serif

## Modules

* __SilverStripe Optimised Image:__ Automatically runs any image resampled by SilverStripe through jpegoptim, optipng etc. (Thanks to @HeyDay !)