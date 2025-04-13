Note all the models must use manual docblock in the top to point what @property and types it has

1. Address: { id: uuid, -- then generate something that we will resolve from google place ID, softdeletes, timestamps }
2. Contact: { id: uuid, phone: string64|null, phone_2: string64|null, phone_3|null: string_64|null, email: string255, email_2: string255|null, avatar: text|null, timestamps } 
2. Company: { id: uuid, name: string, address_id: uuid-fk-addresses.id, contact_id: uuid-fk-contacts.id|null, softdeletes, timestamps }
3. User: { id: uuid, company_ud: uuid-fk-companies.id, email: string255, password, address_id: uuid-fk-addresses.id, contact_id: uuid-fk-contacts.id|null, first_name: string128, last_name: string128, is_active: boolean, softdeletes, timestamps }
4. Agent { id: uuid, company_id: uuid-fk-companies.id, contact_id: uuid-fk-contacts.id|null, softdeletes, timestamps }
5. Location: { id: uuid, address: uuid-fk-addresses.id, location_image_id: uuid-fk-location_images.id, name: string255, is_active: boolean, mls: string32, softdeletes, timestamps }
5. NFCQRTag: { id: uuid, name: string255, code: string8, is_active: boolean, softdeletes, timestamps }
6. Campaign: { id: uuid, name: string255, payload: this-will-be-a-big-json, is_active: boolean, softdeletes, timestamps }
7. Location_NFCQRTag many to many
8. Location_Campaign many to many with pivot column { active_from: datetime, default: boolean }
9. VisitorIdentified - come with a better name. I need this to be a model that groups non unique visitors under an identified visitor model that I will use later. You will find the next model is Visitor. That's where it is calculated from
10. Visitor: { id: uuid, location_id: uuid-fk-locations.id, VisitorIdentified_id: uuid-fk-VisitorIdentified.id, collected_data: json, softdeletes, timestamps } - need indices [location_id, created_at]
11. LocationImage { id: uuid, location_id: uuid-fk-locations.id, source: text, order: number|null, timestamps }
12. LocationPricing { id: uuid, location_id: uuid-fk-locations.id, price_before: unsigned big integer, price_after: unsigned big integer|null, active_from: datetime, timestamps } -- Location hasMany pricing latest by active_from
13. LocationFeature { id: uuid, location_id: uuid-fk-locations.id, feature: string32 - casted to PHP Enum LocationFeatureName, value: string255, timestamps }
14. LocationMeta { id: uuid, location_id: uuid-fk-locations.id, key: string - casted to PHP Enum LocationMetaKey, value: text, timestamps }

LocationMetaKey cases:
Property Type
Building Type
Neighbourhood Name
Title
Built in
Annual Property Taxes
Parking Type
Parking Lots
Bedrooms
Bathrooms
Square Footage
Land Size
Unique building feature
Heating & Cooling
Unique Neighbourhood Features
Maintenance or Condo Fee Price
Maintenance or Condo Fee Info
Other Land Feature

16. LocationRoom { id: uuid, location_id: uuid-fk-locations.id, name: string64, sqft: unsigned int | null, x_imperial: string8|null, y_imperial: string8|null, x_metric: float5,2|null, y_imperial: float5.2|null, timestamps }
