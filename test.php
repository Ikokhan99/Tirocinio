<script>
    if (String(window.performance.getEntriesByType("navigation")[0].type) === "back_forward" || String(window.performance.getEntriesByType("navigation")[0].type) === "reload") {
        console.log("ciccio balena");
    }
</script>
