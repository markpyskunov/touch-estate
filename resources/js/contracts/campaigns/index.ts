import {Field} from "@/contracts/campaigns/fields";
import {Flags} from "@/contracts/campaigns/flags";

export interface Campaign {
    id: string;
    fields: Field[];
    flags?: Flags;
}
