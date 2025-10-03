<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Security\Member;

/**
 * LoginSessionExtension
 *
 * Required for the "Recent Active Users" report. Manages permissions
 * for viewing and deleting login sessions.
 */

class LoginSessionExtension extends Extension
{
    /**
     * @param Member $member
     */
    protected function canView($member)
    {
        if ($this->getOwner()->Member()->canView($member)) {
            // If you can view a Member, you can also view their sessions.
            // This does not allow you to terminate their session.
            return true;
        };
    }

    /**
     * @param Member $member
     */
    protected function canDelete($member)
    {
        if ($this->getOwner()->Member()->canEdit($member)) {
            // If you can edit a Member, you can also log them out of a session.
            // This action is aligned to canDelete, because logging a user out is
            // equivalent to deleting the LoginSession.
            return true;
        };
    }
}