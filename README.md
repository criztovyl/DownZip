#ABOUT
DLUnzip is a PHP script which downloads a ZIP and extracts it.
There is a secured and unsecured version. In the secured you need a Auth\_Key to start the Download, the keys are defined in the file. (See [Configuration](#configuration).

#INSTALL
Extract the archive and upload DLUnzip.php and/or DLUnzipSecured.php to your webspace.

#CONFIGURATION

For dlandunzip.php you need no configuration, simply upload and start!

In the secured version you have to insert an key into the "auth\_keys" array. Each key as a string with quotation marks, seperated by "," inside the bracelets.

Example:
Before:
    
    $auth_keys = array();

After:

    $auth_keys = array("key1", "key2", "key3");


##COOKIES

There is a text-field where you can enter cookies :)

#LINKS

[Homepage] (http://www.joinout.de/dlunzip)  
[GitHub] (http://github.com/criztovyl/dlunzip)

#LICENSE

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

#AUTHOR

Written by Christoph "criztovyl" Schulz, <ch.schulz@joinout.de>

[Homepage] (http://criztovyl.joinout.de)  
[GitHub] (http://github.com/criztovyl)

