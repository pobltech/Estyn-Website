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
            'thematicReportData' => $this->thematicReportData(),
            'quickLinks' => $this->quickLinks(),
            'thematicReportResources' => $this->thematicReportResources()
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

        $fullReportDownloadURL = $this->getThematicReportDownloadURL(get_the_ID());
        $language = pll_current_language();
        if (empty($fullReportDownloadURL)) {
            // If we've reached this point, then maybe the report in the current language doesn't have any files,
            // but the report in the other language does. If so, we should return the URL to the other language's report.
            // Use PLL function to get the post in the other language
            if(!function_exists('pll_current_language')) {
                // Give up
                //error_log('pll_current_language() function does not exist');
                return [
                    'fullReportDownloadURL' => null
                ];
            }

            $otherLanguage = pll_current_language() === 'en' ? 'cy' : 'en';
            $language = $otherLanguage;
            //error_log('Other language = ' . $otherLanguage);

            $otherLanguagePost = pll_get_post(get_the_ID(), $otherLanguage);
            if (empty($otherLanguagePost)) {
                // Give up
                //error_log('No post found in ' . $otherLanguage . ' for post ID ' . get_the_ID());
                return [
                    'fullReportDownloadURL' => null
                ];
            }

            $fullReportDownloadURL = $this->getThematicReportDownloadURL($otherLanguagePost);

            if(empty($fullReportDownloadURL)) {
                // Give up
                //error_log('No download URL found for post in other language, ID ' . $otherLanguagePost);
                return [
                    'fullReportDownloadURL' => null
                ];
            }
        }

        // Sort out the summary/excerpt
        $summary = null;
        if(has_excerpt(get_the_ID())) {
            $summary = get_the_excerpt();
        }/* else {
            // If this post's title includes the words "training materials" then there should be an associated
            // post that we can take the excerpt from. "Associated post" is if the title matches the title of this post (minus " - training materials")
            $title = strtolower(get_the_title());
            
            if(strpos($title, 'training materials') !== false) {

// Decode HTML entities to their respective characters
$title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');

// Replace all types of hyphens and dashes with a standard hyphen
$title = preg_replace('/[\p{Pd}]/u', '-', $title);

// Remove specific unwanted substrings
$title = str_replace(['- training materials', '-training materials', 'training materials', '- deunydd hyfforddiant', '-deunydd hyfforddiant', 'deunydd hyfforddiant'], '', $title);

// Remove non-standard characters using a regular expression
$title = preg_replace('/[^\x20-\x7E]/', '', $title);

// Trim the string to remove any leading or trailing whitespace
$title = trim($title);

// Remove the last character if it's a non-standard character
$title = rtrim($title, "-");

// Final trim to ensure no leading or trailing whitespace
$title = trim($title);

$title = substr($title, 0, -1);

                
                $reports = get_posts([
                    'post_type' => 'estyn_imp_resource',
                    'posts_per_page' => -1,
                    
                    'lang' => pll_get_post_language(get_the_ID()),
                    'tax_query' => [
                        [
                            'taxonomy' => 'improvement_resource_type',
                            'field' => 'slug',
                            'terms' => 'thematic-report'
                        ]
                    ]
                ]);

                if(!empty($reports)) {
                    foreach($reports as $report) {
                        if(strpos(strtolower(get_the_title($report->ID)), $title) === false) {
                            continue;
                        }

                        if(!has_excerpt($report->ID)) {
                            continue;
                        }

                        if(strpos(strtolower(get_the_title($report->ID)), 'training materials') !== false) {
                            continue;
                        }

                        $summary = get_the_excerpt($report->ID);
                        break;
                    }
                }
            }
        } */

        return [
            'fullReportDownloadURL' => $fullReportDownloadURL,
            'fullReportLanguage' => $language,
            'summary' => $summary
        ];
    }

    private function urlEncodeEstynOldFilePath($path) {
        // Paths are in the form private/files/filename.pdf or files/filename.pdf
        // AND in some cases the filename is not safe for URLs, so we need to encode it
        $pathParts = explode('/', $path);
        $filename = array_pop($pathParts);
        $filename = rawurlencode($filename);
        $pathParts[] = $filename;

        return implode('/', $pathParts);
    }

    private function getThematicReportDownloadURL($postID) {
        // Check for ACF field first
        $fullReportFile = get_field('full_report_file', $postID);
        if (!empty($fullReportFile)) {
            return $fullReportFile['url'];
        }
        
        // Check for attached files next, of PDF or PPTX type
        $attachments = get_posts([
            'post_type' => 'attachment',
            'post_parent' => $postID,
            'post_mime_type' => ['application/pdf', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'],
            'posts_per_page' => -1
        ]);

        if (!empty($attachments)) {
            $attachment = $attachments[0];
            return wp_get_attachment_url($attachment->ID);
        }
        
        // Check for old meta fields, which may have been used during import from the old site
        $pdfs = get_post_meta($postID, 'pdfs_uris', true);
        if (!empty($pdfs)) {
            $pdfs = explode('|', $pdfs);
            return ESTYN_OLD_FILES_URL . $this->urlEncodeEstynOldFilePath($pdfs[0]);
        }

        $documents = get_post_meta($postID, 'documents_uris', true);
        if (!empty($documents)) {
            $documents = explode('|', $documents);
            return ESTYN_OLD_FILES_URL . $this->urlEncodeEstynOldFilePath($documents[0]);
        }

        $nodeFiles = get_post_meta($postID, 'document_node_files_uris', true);
        if (!empty($nodeFiles)) {
            $nodeFiles = explode('|', $nodeFiles);
            return ESTYN_OLD_FILES_URL . $this->urlEncodeEstynOldFilePath($nodeFiles[0]);
        }

        return null;
    }
    private function quickLinks() {
        $content = apply_filters('the_content', get_the_content());
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Temporarily disable libxml errors

        // Ensure UTF-8 encoding and add doctype for HTML5, then load the content
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
        $dom->loadHTML('<?xml encoding="UTF-8">' . $content);

        libxml_clear_errors(); // Clear any libxml errors that have been caught

        $headings = [];

        for ($i = 1; $i <= 6; $i++) {
            $currentHeadings = $dom->getElementsByTagName('h' . $i);
            foreach ($currentHeadings as $heading) {
                $headings[] = $heading;
            }
        }

        $links = [];

        foreach ($headings as $heading) {
            if ($heading instanceof \DOMElement) {// && $heading->hasAttribute('id')) {
                //$id = $heading->getAttribute('id');
                //if (!empty($id)) {
                    $links[] = [
                        'title' => $heading->textContent,
                        //'link' => '#' . $id
                        'link' => '#'
                    ];
                //}
            }
        }
        
        return $links;
    }

    private function thematicReportResources() {
        /**
         * ACF Repeater field, with subfields 'resource_file' (File field),
         * 'title' (Text field),
         * and 'resource_post' (Relationship field. Max 1 post. If not empty, overrides 'resource_file').
         * If 'title' is empty then we use the filename of resource_file or title of resource_post.
         */
        
        $resources = get_field('thematic_report_resources');

        if (empty($resources)) {
            return [];
        }

        $formattedResources = [];

        foreach ($resources as $resource) {
            $title = $resource['title'];
            $file = $resource['resource_file'];
            $post = $resource['resource_post'];

            if (empty($title)) {
                if (!empty($file)) {
                    $title = $file['title'];
                } elseif (!empty($post)) {
                    $title = get_the_title($post[0]->ID);
                }
            }

            $formattedResources[] = [
                'title' => $title,
                'file' => !empty($post) ? get_the_permalink($post[0]->ID) : $file['url']
            ];
        }

        return $formattedResources;
    }
}