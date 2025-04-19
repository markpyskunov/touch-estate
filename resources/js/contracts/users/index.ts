import {Address} from "@/contracts/address";
import {UserCompany} from "@/contracts/companies";
import {Contact} from "@/contracts/contacts";

export interface OwnerUser {
    id: string;
    first_name: string;
    last_name: string;
    company: UserCompany;
    address: Address;
    contact: Contact;
}
