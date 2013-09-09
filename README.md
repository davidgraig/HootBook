HootBook
========

Overview
--------
HootBook is a small address book for a technical challenge issued by HootSuite.

Implemented Operations:

* Account Registration (as well as updating and deletion)
* Account Login
* Account specific Contacts
 + Add, edit, delete, view contacts
 + Contacts display twitter information (followers, images)
* Contact searching (filtering)
* Contact sorting

Twitter API considerations
--------------------------

The twitter API call is rate limited to 60 requests / 15 minutes.  Calls to the API were limited by using a cache, and pooling twitter data for reuse between users.