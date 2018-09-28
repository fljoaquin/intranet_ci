$(function() {

    // define tour
    var tour = new Tour({
        debug: true,
        basePath: location.pathname.slice(0, location.pathname.lastIndexOf('/')),
        steps: [
            {

                element: ".reward-fulfillment",
                placement: "top",
                title: "Rewards Fulfillment",
                content: "This is a Report Screen where you can find members that had leveled up and you can export it into a CSV file."
            }, {
                //path: "/",
                element: ".new-patient-report",
                placement: "top",
                title: "New Member Report",
                content: "This is a Report Screen, very similar to 'Rewards Fulfillment', but specific for all new members. This allows you to send the Loyalty Card that we further will talk about."
            }, {
                //path: "/",
                element: ".assign-rewards",
                placement: "top",
                title: "Assign a Reward",
                content: "Yeah! Here comes the fun! In this screen you will be able to assign or reward our patients. Later we will discuss about this feature."
            }, {
                //path: "/api",
                element: ".member-search",
                placement: "top",
                title: "Member Search",
                content: "Over Member Search you will be able to Search for Members to provide them information about 'Points', 'Rewards', and so much that we will disclose in a few more clicks.",
                reflex: true
            }, {
                path: "/rewardsFulfillmentUI.php",
                element: "#rewards-fulfillment-table",
                placement: "bottom",
                title: "Rewards Fulfillment",
                content: "Let me take you to the actual Rewards Fulfillment Screen.",
                backdrop: true,
                reflex: true

            }, {
                //path: "/api",
                element: "#export-to-excel-btn",
                placement: "bottom",
                title: "Export List to CSV",
                content: "Clicking 'Export to Excel' will download a list with the actual report. \n Tip: It can be open with Excel. ;)",
                reflex: true
            }, {
                //path: "/api",
                element: "#reflex",
                placement: "bottom",
                title: "Reflex mode",
                content: "Reflex mode is enabled, click on the text in the cell to continue!",
                reflex: true
            }, {
                //path: "/api",
                title: "And support for orphan steps",
                content: "If you activate the orphan property, the step(s) are shown centered in the page, and you can\nforget to specify element and placement!",
                orphan: true,
                onHidden: function() {
                    return window.location.assign("index.php");
                }
            }
        ]
    });

    // init tour
    tour.init();

    // start tour
    $('#start-training').click(function() {
        tour.restart();
    });


});
