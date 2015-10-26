describe("PlatformsReport", function () {
    this.timeout(0);

    this.fixture = "Piwik\\Tests\\Fixtures\\ManyVisitsWithMockLocationProvider";

    var generalParams = 'idSite=1&period=day&date=2010-01-03',
        urlBase = 'module=CoreHome&action=index&' + generalParams,
        visitorsOverviewUrl = "?" + urlBase + "#/?" + generalParams + "&module=VisitsSummary&action=index";

    it("should load from the visitors menu correctly", function (done) {
        expect.screenshot('report').to.be.captureSelector('.pageWrap,.expandDataTableFooterDrawer', function (page) {
            page.load(visitorsOverviewUrl);
            page.click('.Menu--dashboard a.item:contains(Platforms):visible');
        }, done);
    });

    it("should load the related report correctly", function (done) {
        expect.screenshot('related_report').to.be.captureSelector('.pageWrap,.expandDataTableFooterDrawer', function (page) {
            page.click('.datatableRelatedReports span:visible');
        }, done);
    });
});
