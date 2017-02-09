<?php

class rss
{

    private $document, $channel;

    private function element($name, $value = null, $attributes = array())
    {
        $element = $this->document->createElement($name);

        if (is_null($value) === false) {
            $text = $this->document->createTextNode($value);
            $element->appendChild($text);
        }

        foreach ($attributes as $key => $val) {
            $element->setAttribute($key, $val);
        }

        return $element;
    }

    public function __construct($name, $description, $url, $language)
    {
        // create a dom xml object
        $this->document = new DOMDocument('1.0', 'UTF-8');
        $this->document->preserveWhiteSpace = false;
        $this->document->formatOutput = true;

        // create our rss feed
        $rss = $this->element('rss', null, array('version' => '2.0', 'xmlns:atom' => 'http://www.w3.org/2005/Atom'));
        $this->document->appendChild($rss);

        // create channel
        $this->channel = $this->element('channel');
        $rss->appendChild($this->channel);

        // title
        $title = $this->element('title', $name);
        $this->channel->appendChild($title);

        // link
        $link = $this->element('link', $url);
        $this->channel->appendChild($link);

        // description
        $description = $this->element('description', $description);
        $this->channel->appendChild($description);

        // laguage
        // http://www.rssboard.org/rss-language-codes
        $language = $this->element('language', $language);
        $this->channel->appendChild($language);

        $ttl = $this->element('ttl', 60);
        $this->channel->appendChild($ttl);

        $docs = $this->element('docs', 'http://blogs.law.harvard.edu/tech/rss');
        $this->channel->appendChild($docs);

        $copyright = $this->element('copyright', $name);
        $this->channel->appendChild($copyright);

        // atom self link
        $atom = $this->element('atom:link', null, array(
            'href' => $url,
            'rel' => 'self',
            'type' => 'application/rss+xml'
        ));
        $this->channel->appendChild($atom);
    }

    public function item($title, $url, $description, $date, $comments, $category_title, $category_slug, $image)
    {
        $item = $this->element('item');
        $this->channel->appendChild($item);

        // guid
        $guid = $this->element('guid', $url);
        $item->appendChild($guid);

        // title
        $title = $this->element('title', $title);
        $item->appendChild($title);

        // link
        $link = $this->element('link', $url);
        $item->appendChild($link);

        // description image
        if ($image) {
            $description = "<img src=\"" . $image . "\" />" . $description;
        }
        // description
        $description = $this->element('description', $description);
        $item->appendChild($description);

        // date
        $date = $this->element('pubDate', date(DATE_RSS, strtotime($date)));
        $item->appendChild($date);

        // comments
        if ($comments) {
            $comments = $this->element('comments', $url . '#comment');
            $item->appendChild($comments);
        }

        // category
        $category = $this->element('category', $category_title, array(
            'domain' => $category_slug
        ));
        $item->appendChild($category);
    }

    public function output()
    {
        // dump xml tree
        return $this->document->saveXML();
    }
}
