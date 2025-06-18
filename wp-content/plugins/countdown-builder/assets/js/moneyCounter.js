document.addEventListener("DOMContentLoaded", function () {
    const counterEl = document.getElementById('ycd-money-counter');
    if (!counterEl) return;

    const initialValue = parseFloat(counterEl.getAttribute('data-initial')) || 0;
    const increasePerSec = parseFloat(counterEl.getAttribute('data-increase')) || 0;
    const startDateStr = counterEl.getAttribute('data-start-date');
    const decimals = parseInt(counterEl.getAttribute('data-decimals')) || 0;
    const prefix = counterEl.getAttribute('data-prefix') || '';
    const targetValue = parseFloat(counterEl.getAttribute('data-target')) || null;

    const fontSize = counterEl.style.fontSize;
    counterEl.style.fontSize = fontSize;
    
    let startDate = new Date(startDateStr);
    let now = new Date();

    let elapsedSeconds = Math.max(0, Math.floor((now - startDate) / 1000));
    let currentValue = initialValue + (increasePerSec * elapsedSeconds);

    function formatNumber(value) {
        return value.toLocaleString(undefined, {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals
        });
    }

    function updateCounter() {
        currentValue += increasePerSec;
        if (targetValue && currentValue >= targetValue) {
            currentValue = targetValue;
            clearInterval(timer);
        }
        counterEl.innerHTML = prefix + formatNumber(currentValue);
    }

    counterEl.innerHTML = prefix + formatNumber(currentValue);
    const timer = setInterval(updateCounter, 1000);
});