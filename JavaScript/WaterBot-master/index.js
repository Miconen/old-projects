const Discord = require('discord.js');
const client = new Discord.Client();
const config = require("./config.json");
const waterfacts = require("./quotes.json");
const waterball = require("./waterball.json");

const waterfacts_length = Object.keys(waterfacts).length;
// Defines amount of options (positive, non-committal & negative)
const waterball_length = Object.keys(waterball).length;
// Get positive options index amount
const waterball_positive_length = Object.keys(waterball.positive).length;
// Get non-committal options index amount
const waterball_non_committal_length = Object.keys(waterball.non_committal).length;
// Get negative options index amount
const waterball_negative_length = Object.keys(waterball.negative).length;

// For commands, commands won't run without prefixing them with this.
const prefix = ';';

// Load up trigger
client.on('ready', () => {
    console.log('Logged in as ' + client.user.tag);
});

// On message trigger
client.on('message', msg => {
    // TODO; Add support for arguments in commands

    // Message sanitization
    // Check for prefix
    if (msg.content.startsWith(prefix) === false) {
        return;
    }
    // Make a variable (commandMessage) that eases message handling using...
    // Remove prefix for easier command handling with .slice()
    // (Removes first letter)
    // Make message content lowercase for easier handling with .toLowerCase()
    // (Makes everything lower case)
    var commandMessage = msg.content.slice(1).toLowerCase();

    // Switch case for handling future commands
    switch (commandMessage) {
        // Gives random facts about water
        case 'waterfact':
            // Returns a random data pair from quotes.json
            msg.reply(waterfacts[Math.floor(Math.random()*waterfacts_length)]);
            break;
        // Magic 8 ball knockoff fun command
        case 'waterball':
            // Select a random answer from waterball.json
            // Roll random number between lenght of waterball (waterball_length)
            // This basically selects from the 3 different main options
            var waterballOption = Math.floor(Math.random()*waterball_length);
            // Which search result we're getting from one of the selected 3 options
            // The reason for defining this multiple times in the upcoming switch is cause..
            // The different options have different amount of indexes in them.
            // We're trying to prevent possible problems by not calling a non-existing index accidentally.
            var waterballIndex;
            // Translate random number to text and get options lenght
            // We translate to text cause waterball.json index elements use text
            switch (waterballOption) {
                case 0:
                    // Positive selection
                    var waterballOption = 'positive';
                    // Get positive selections lenght
                    var waterballIndex = Math.floor(Math.random()*waterball_positive_length);
                    break;
                case 1:
                    // Non-committal selection
                    var waterballOption = 'non_committal';
                    // Get non-committal selections lenght
                    var waterballIndex = Math.floor(Math.random()*waterball_non_committal_length);
                    break;
                case 2:
                    // Negative selection
                    var waterballOption = 'negative';
                    // Get negative selections lenght
                    var waterballIndex = Math.floor(Math.random()*waterball_negative_length);
                    break;
                default:
            }
            // Reply with the result from waterball
            msg.reply(waterball[waterballOption][waterballIndex]);
            break;
        // Test command, simply returns splash when given splish
        // Only executes if previous checks such as prefix is fulfilled
        case 'splish':
            msg.reply('Splash');
            break;
        default:
    }
});

// Connect to discord servers using bot token from config.json ("token": YOUR_TOKEN)
// For your bot token go to https://discordapp.com/developers/applications/
client.login(config.token);
