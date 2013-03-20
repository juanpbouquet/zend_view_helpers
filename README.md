zend_view_helpers
===================

Some general purpose Zend View Helpers I made for LaSuricata.com, but that can be used in any kind of project. They provide some basic functionalities that are used on most of my projects, so I keep using them across my developments.

EmbedYoutube
------------
This helper generates the HTML code for embedding Youtube just providing the video id. Many of the options available are not user-known and not available from YouTube's Embed Widget, so I took all options from APIs documentation and generated a generic-ish implementation to "disguise" YouTube embeds a little bit. A working demo of how much a YouTube video can be modified can be seen, for example, on this URL: http://www.playxfun.com/detalle/994/metal-gear-rising-revengeance

FilterString
------------
This helper converts an array of parameters in a single string that can be used in a GET parameter or URL segment. I use it mostly for applying several filters (search string, pagination, order, etc.) to the same page, listing or catalog, without having a huge URL. 

HumanDate
---------
Generates Facebook/Twitter like timestamps. In a lot of cases, showing "2 minutes ago" is way more easier to read than 2012-12-01 23:30:10, specially for short term datetimes. It may be unacurrate on bigger periods of time, but still fancy to display :)

OpenGraph
---------
Zend Framework's HeadMeta helper is strict, so you can't add Open Graph metatags on HTML5. Well, you can add them, but the way Zend does it (and it's the right way according to HTML5 specifications) is not the way Facebook reads it. It's a shame but this helper will create NON-HTML5-VALID metatags to use custom Open Graph types and attributes.
