HootBook
========

Overview
---
HootBook is a small address book for a technical challenge issued by HootSuite.

Implemented Operations:

* Account Registration (as well as updating and deletion)
* Account Login
* Account specific Contacts
 + Add, edit, delete, view contacts
 + Contacts display twitter information (followers, images)
* Contact searching (filtering)
* Contact sorting

Instructions
---

1. Create a new Account by filling out the Registration form
2. Create contacts by using the form displayed.
3. You can filter your contact list by using the "Search Contact Name" text field in the upper right.
4. To update/delete your account click the Edit Profile link in the top right.
5. To Log Out, click the Logout link in the upper right.

Note: When the twitter API rate limit is reached, a message will be displayed where the followers count would be - "couldn't retrieve follower count - check back later".
This will only occur when the API limit has been reached and a new contact is added.


Technical Details
---

* The address book was written using the Yii MVC Framework (http://yiiframework.com).
* The twitter API call (users/lookup) is rate limited to 60 requests / 15 minutes.  Calls to the API are limited by using a cache, and pooling twitter data for reuse between users.