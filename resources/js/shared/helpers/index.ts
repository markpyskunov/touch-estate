export const formatCurrency = (valueInCents: number, currency = 'CAD', locale = 'en-CA') => {
    return new Intl.NumberFormat(locale, {
        style: 'currency',
        currency,
        minimumFractionDigits: 0,
    }).format(valueInCents / 100);
};

export const formatDate = (date: Date|string): string => {
    const dateInstance = typeof date === 'string'
        ? new Date(date)
        : date;

    return new Intl.DateTimeFormat('en-US', {
        month: 'short',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric'
    }).format(dateInstance)
}
