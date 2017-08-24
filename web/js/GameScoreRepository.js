function GameScoreRepository()
{
    /**
     * @param {GameScore} score
     * @param {function} callback
     */
    this.submit = function (score, callback)
    {
        $.ajax({
            method: 'POST',
            url: '/api/scores',
            data: JSON.stringify(score),
            success: function () {
                callback();
            }
        })
    }
}