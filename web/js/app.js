function app()
{
    /**
     * @type {TeamOverviewController}
     */
    this.TeamOverviewController = undefined;

    /**
     * @type {ScoreOverviewController}
     */
    this.ScoreOverviewController = undefined;
}

app.init = function ()
{
    this.TeamOverviewController = new TeamOverviewController();
    this.TeamOverviewController.init();

    this.ScoreOverviewController = new ScoreOverviewController();
    this.ScoreOverviewController.init();
};