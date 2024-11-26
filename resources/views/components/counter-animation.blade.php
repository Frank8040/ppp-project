<div x-data="counterAnimation(1, {{ $slot }}, 1000)">
    <span x-text="currentNumber"></span>
</div>

<script>
    function counterAnimation(start, end, duration) {
        return {
            currentNumber: start,
            startCounting() {
                const stepTime = Math.abs(Math.floor(duration / (end - start)));
                let interval = setInterval(() => {
                    this.currentNumber++;
                    if (this.currentNumber >= end) {
                        clearInterval(interval);
                    }
                }, stepTime);
            },
            init() {
                this.startCounting();
            }
        };
    }
</script>
