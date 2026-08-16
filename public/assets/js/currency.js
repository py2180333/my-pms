// currency.js
(function (global) {
    const currencies = [
        { country: "India", code: "INR", symbol: "₹" },
        { country: "United States", code: "USD", symbol: "$" },
        { country: "United Kingdom", code: "GBP", symbol: "£" },
        { country: "Japan", code: "JPY", symbol: "¥" },
        { country: "Canada", code: "CAD", symbol: "CA$" },
        { country: "Australia", code: "AUD", symbol: "A$" },
        { country: "Eurozone", code: "EUR", symbol: "€" },
        { country: "UAE", code: "AED", symbol: "د.إ" },
        
    ];

    function populateCurrencyDropdown(selectElementId) {
        const selectElement = document.getElementById(selectElementId);

        if (!selectElement) {
            console.error(`Element with ID "${selectElementId}" not found.`);
            return;
        }

        currencies.forEach(({ country, code, symbol }) => {
            const option = document.createElement('option');
            option.value = code;
            option.textContent = `${country} (${code}) ${symbol}`;
            selectElement.appendChild(option);
        });
    }

    function handleCurrencyChange(selectElementId, callback) {
        const selectElement = document.getElementById(selectElementId);

        if (!selectElement) {
            console.error(`Element with ID "${selectElementId}" not found.`);
            return;
        }

        selectElement.addEventListener('change', function () {
            const selectedCurrency = this.value;
            const selectedDetails = currencies.find(c => c.code === selectedCurrency);
            callback(selectedDetails);
        });
    }

    global.CurrencyHelper = {
        populateCurrencyDropdown,
        handleCurrencyChange,
    };
})(window);
