/**
 * @param {number} id
 * @param {string} firstPlayer
 * @param {string} secondPlayer
 * @constructor
 */
function Team(id, firstPlayer, secondPlayer)
{
    /**
     * @type {number}
     */
    this.id = id;

    /**
     * @type {string}
     */
    this.firstPlayer = firstPlayer;

    /**
     * @type {string}
     */
    this.secondPlayer = secondPlayer;
}