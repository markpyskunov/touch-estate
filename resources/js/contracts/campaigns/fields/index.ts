interface InputTextValidation {
    min?: number;
    max?: number;
    pattern?: string;
}

type Validation =
    | InputTextValidation;

interface InputTextField {
    id: string;
    required: boolean;
    label: string;
    type: 'input[type=text]';
    validation: Validation;
}

export type Field =
    | InputTextField;
