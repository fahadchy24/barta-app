<script>
    function search() {
        return {
            query: '',
            results: [],
            open: false,

            fetchResults() {
                if (this.query.length > 0) {
                    fetch(`{{ route('user.search') }}?query=${this.query}`)
                        .then(response => response.json())
                        .then(data => {
                            this.results = data;
                            this.open = true;
                        });
                } else {
                    this.results = [];
                    this.open = false;
                }
            },

            selectResult(result) {
                this.query = result.name;
                this.open = false;
            }
        };
    }
</script>
