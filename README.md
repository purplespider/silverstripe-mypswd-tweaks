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
* __LeftAndMainPageIconsExtension:__ Fixes the [bug](https://github.com/silverstripe/silverstripe-cms/issues/798) that causes the site tree page icons to not load if the CMS is opened at a tab other than Pages (eg Dashboard). (Thanks @kinglozzer for the fix.)

## Page Types

* __FirstChildRedirect:__ Automatically redirects to the first child of the page. Useful for top level pages with no content of their own.

## Tasks

* __CheckAllTemplates:__ Copy of [Nicolaas Francken's CheckAllTemplates script](https://github.com/sunnysideup/silverstripe-templateoverview/blob/master/code/tasks/CheckAllTemplates.php) for testing all tempalates/page types.

## Config

* __Default Paste as Plain Text:__ Makes Past as Plain text in TinyMCE turned on by default. Useful to avoid all those stray tags caused by clients pasting from Word.
* __Disable TinyMCE Icons:__ Disables useless icons such as underline, and brokedn Spell Checker.
* __Default Better Buttons Config File:__ A custom [Better Buttons](https://github.com/unclecheese/silverstripe-gridfield-betterbuttons) config file, with "Save & Close" and "Save & Add" buttons for Create, and "Save & Close" and "Save & Next" for Edit.

## CMS CSS

* __Hides Error Pages:__ Hides error pages from the site tree.
* __Differentiate Hidden Pages:__ Pages that have "Show in menus?" unchecked, are gray in the site tree.
* __Dashboard Color Tweak:__ Tweaks the background colour of widgets in [Unclecheese's Dashboard module](https://github.com/unclecheese/silverstripe-dashboard), to match rest of CMS color scheme better. 