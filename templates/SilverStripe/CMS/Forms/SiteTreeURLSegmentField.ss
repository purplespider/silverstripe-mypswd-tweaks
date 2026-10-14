<div class="preview-holder">
    <a class="URL-link"
        href="$URL"
        target="_blank"
        title="<%t SilverStripe\\CMS\\Forms\\SiteTreeURLSegmentField.ViewDraft 'View the draft page' %>">
        <%-- An aria-label attribute is dynamically added in SiteTreeURLSegmentField.js --%>
        $URL
    </a>
    <div class="btn-group">
        <%-- Behaviour in client/dist/url-copy.js --%>
        <button type="button" class="btn btn-outline-secondary btn-sm url-copy font-icon-p-multi" data-url="{$URLPrefix}{$Value}" title="Copy the published page's URL">
            <span class="url-copy__label" aria-live="polite">Copy link</span>
        </button>
        <% if not $IsReadonly %>
        <button role="button" type="button" class="btn btn-outline-secondary btn-sm edit font-icon-edit">
            <%t SilverStripe\CMS\Forms\SiteTreeURLSegmentField.Edit 'Edit' %>
        </button>
        <% end_if %>
    </div>
</div>

<div class="edit-holder">
    <div class="input-group">
        <input $AttributesHTML />
        <button role="button" type="button" class="btn btn-primary update">
            <%t SilverStripe\CMS\Forms\SiteTreeURLSegmentField.OK 'OK' %>
        </button>
        <button role="button" type="button" class="btn btn-outline-secondary btn-sm cancel">
            <%t SilverStripe\CMS\Forms\SiteTreeURLSegmentField.Cancel 'Cancel' %>
        </button>
    </div>
    <% if $HelpText %><p class="form__field-description">$HelpText</p><% end_if %>
</div>
