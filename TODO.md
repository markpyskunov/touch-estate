# P1

Login to admin area

# P2

UI Visitors Dashboard
UI Visitors list
UI Properties list / edit
UI NFC QR tag list / edit
UI Campaigns list / edit

# P3

Printable PDF cover builder.
Should print on a single A4 paper.
Should use themes (One builder class = one theme)

# P4

- Users
- Locations
    - Location Documents
    - Location Features
    - Location Images
    - Location Metas
    - Location Pricing
    - Location Rooms
- NFC/QR Tags
- Campaigns
- Visitors

# P5

Follow up emails / SMS
Collect consent for further contacts
Offer subscribe
Offer like
Offer to leave a comment (note) if they entered for like/subscribe

# P6

For those, who visit many properties in recent 14 days - create notification to their realtor that it is a hot lead

# Unclassified / Unprioritized

# Super Admin

## Dashboards

- Companies
- Users
- Usage
- Visitors

## CRUD

- Companies
- Users

# Admin

## Dashboards

- Visitors
- Usage

## CRM

- Contacts
- Communications

------------------
# Visitors algo

On scanning will land on the auth page.
Must select SMS or Email.
Will be sent with a code in both cases to verify.
Will get HTTP Cookie for identification (VID).

It matters Visitor to where - so that Key attributes are: Location ID, and Campaign ID together with VID.
It will allow to create a guard.
Visitor is cached for 2 days using redis (guard).

Repeated visit frequently than 60 mins won't be recorded as a new one.
So that when they reload page - it is not causing new "visitor" every time.
It matters the source of visit. Can be
- QR (they've used QR as entry point)
- NFC (they've used NFC as entry point)
- Website (they've returned home and opening it again after follow up email)

The VisitController@verifyCodeAndCollectVerifiedData - stores a visit

Using VID we are also trying to collect all available emails and phones.
So that each time they verify themselves - they are providing phone or email => we want to collect it all.

Please also note the visitor is attached to location using VID + Location ID (disregard Campaign ID).

We also track:
- Visitor likes
- Visitor subscriptions
- Visitor notes
- ...Tons of events...
