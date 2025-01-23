$(document).ready(function () {
    // Configure Bloodhound
    var menuSuggestions = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace, // Tokenize the query
        queryTokenizer: Bloodhound.tokenizers.whitespace, // Tokenize the data
        remote: {
            url: base + "/dashboard/suggestions?q=%QUERY",
            wildcard: '%QUERY', // Placeholder for the query
            transport: function (options, onSuccess, onError) {
                // Show spinner and hide search icon before making the request
                $('.search_icon').hide();
                $('.search_spiner').show();

                $.ajax(options)
                    .done(function (data) {
                        onSuccess(data);
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        onError(jqXHR, textStatus, errorThrown);
                    })
                    .always(function () {
                        // Hide spinner and show search icon after the request is completed
                        $('.search_spiner').hide();
                        $('.search_icon').show();
                    });
            }
        }
    });

    // Initialize Typeahead with Bloodhound
    $('#menu-search').typeahead(
        {
            hint: true, // Show hint text
            highlight: true, // Highlight the matching text
            minLength: 0 // Allow suggestions even for empty input
        },
        {
            name: 'menu-items', // Name for the dataset
            source: menuSuggestions, // Use the Bloodhound instance
            limit: 15,
            display: function (data) {
                return data.name; // Define the property to display (adjust based on your data)
            },
            templates: {
                suggestion: function (data) {
                    // Customize how suggestions appear (adjust based on your data structure)
                    return '<div>' + data.name + '</div>';
                },
                notFound: function () {
                    return '<div class="tt-no-result">No results found</div>';
                }
            }
        }
    );

    // Show all suggestions when input is focused and empty
    $('#menu-search').on('focus', function () {
        if ($(this).val() === '') {
            $(this).typeahead('val', ' '); // Trigger a query with an empty space
            $(this).typeahead('val', ''); // Reset the input value
        }
    });

    // Handle redirection on select
    $('#menu-search').bind('typeahead:select', function (event, suggestion) {
        if (suggestion.url) {
            window.location.href = suggestion.url; // Redirect to the URL
        }
    });
});
