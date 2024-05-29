<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ImprovementResourceComposer extends Composer
{
    protected static $views = [
        'partials.content-single-estyn_imp_resource'
    ];

    public function with()
    {
        return [
            'thematicReportData' => $this->thematicReportData()
        ];
    }

    public function thematicReportData() {
        /**
         * Thematic Reports have a lot of meta fields, possible attachments,
         * possible images, mostly from the import of old site data, but newer
         * reports will have different meta etc. The OLD stuff:
         * 
         * Post Meta:
         *
         * document_node_files_uris, documents_uris, pdfs_uris
         *    - Any of these that are not empty should contain at least
         *      one URL to the PDF (or in a handful of cases, PPTX).
         *      If there are multiple, they are separated by a pipe (|).
         *    - The URLs are in the form private/files/... or files/... so
         *      they need to be prefixed with the site's uploads folder URL +
         *      /estyn_old_files/ to be usable.
         *    - It's possible they were attached to the post during import, so
         *      you should check for attachments (of type PDF and PPTX) first.
         *
         *  document_thumbnails_uris
         *    - This is a thumbnail image for the document, if it exists.
         *    - It's possible that there are multiple, separated by a pipe (|).
         *    - The URLs are the full URL to the image, so they should be usable, IF
         *    a search-and-replace for "http://127.0.0.1:8013" on the database has been done.
         *    Alternatively, just use the post's featured image. Hopefully, in all cases, there
         *    was only one image found and therefore got set as the featured image during import.
         *
         *    There's also featured_providers, which is a list of provider post IDs separated by a comma,
         *    and last_updated (yyyymmdd) BUT both of these should be ACF fields which are used by
         *    by all thematic reports, old and new and may have overriden the old meta fields, so
         *    you should try get_field('featured_providers') and get_field('last_updated') first.
         *
         *
         *    The NEW stuff:
         *
         *    ACF Fields:
         *
         *    featured_providers (ACF Relationship field),
         *    last_updated (ACF Date field),
         *    report_resources (ACF Relationship field),
         *    full_report_file (ACF File field)
         */

        return [
            'fullReportDownloadURL' => $this->getThematicReportDownloadURL()
        ];
    }

    private function getThematicReportDownloadURL() {
        // Check for ACF field first
        $fullReportFile = get_field('full_report_file');
        if (!empty($fullReportFile)) {
            return $fullReportFile['url'];
        }
        
        // Check for attached files next, of PDF or PPTX type
        $attachments = get_posts([
            'post_type' => 'attachment',
            'post_parent' => get_the_ID(),
            'post_mime_type' => ['application/pdf', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'],
            'posts_per_page' => -1
        ]);

        if (!empty($attachments)) {
            $attachment = $attachments[0];
            return wp_get_attachment_url($attachment->ID);
        }
        
        // Check for old meta fields, which may have been used during import from the old site
        $pdfs = get_post_meta(get_the_ID(), 'pdfs_uris', true);
        if (!empty($pdfs)) {
            $pdfs = explode('|', $pdfs);
            return ESTYN_OLD_FILES_URL . $pdfs[0];
        }

        $documents = get_post_meta(get_the_ID(), 'documents_uris', true);
        if (!empty($documents)) {
            $documents = explode('|', $documents);
            return ESTYN_OLD_FILES_URL . $documents[0];
        }

        $nodeFiles = get_post_meta(get_the_ID(), 'document_node_files_uris', true);
        if (!empty($nodeFiles)) {
            $nodeFiles = explode('|', $nodeFiles);
            return ESTYN_OLD_FILES_URL . $nodeFiles[0];
        }

        return null;
    }
}