function app()
{
    /**
     * @type {TeamOverviewController}
     */
    this.TeamOverviewController = undefined;
}

app.init = function ()
{
    this.TeamOverviewController = new TeamOverviewController();
    this.TeamOverviewController.init();
};