
# Storage Initializer

Very simple wrapper class to allow initialzation of league/flysystem wrappers, and help provide single item within container for FileSystem.

## Installation

Install via Composer with:

> `composer require apex/storage`

## Basic Usage

~~~php
use Apex\Storage\Storage;

// Get file system
$fs = Storage::init('local', ['dir' => __DIR__ . '/storage']);
~~~


## Support

If you have any questions, issues or feedback for Syrus, please feel free to drop a note on the <a href="https://reddit.com/r/apexpl/">ApexPl Reddit sub</a> for a prompt and helpful response.


## Follow Apex

Loads of good things coming in the near future including new quality open source packages, more advanced articles / tutorials that go over down to earth useful topics, et al.  Stay informed by joining the <a href="https://apexpl.io/">mailing list</a> on our web site, or follow along on Twitter at <a href="https://twitter.com/mdizak1">@mdizak1</a>.



