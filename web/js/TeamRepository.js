function TeamRepository() 
{
    /**
     * @param {Team} team
     */
    this.add = function (team) 
    {
        $.ajax({
            method: 'POST',
            url: '/api/teams',
            data: JSON.stringify(team),
            success: function () {
                location.reload();
            }
        })
    };
}