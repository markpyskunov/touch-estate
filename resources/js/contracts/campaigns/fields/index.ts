interface InputTextValidation {
    min?: number;
    max?: number;
}

type Validation =
    | InputTextValidation;

interface InputTextField {
    id: string;
    required: boolean;
    type: 'input[type=text]';
    validation: Validation;
}

export type Field =
    | InputTextField;
