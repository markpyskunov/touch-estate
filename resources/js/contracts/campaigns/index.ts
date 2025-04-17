import {Field} from "@/contracts/campaigns/fields";
import {Flags} from "@/contracts/campaigns/flags";

export interface Campaign {
    id: string;
    name: string;
    title: string;
    payload: {
        fields: Field[];
        flags: Flags;
    };
}
