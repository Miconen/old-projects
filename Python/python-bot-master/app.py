import discord
import asyncio
import json
import urllib
import urllib.parse
import urllib.request
from credentials import *

# Make some commands use the same api call function using parameters

client = discord.Client()



@client.event
async def on_message(message):
    # Message content variables
    string = message.content
    command = string.lower()
    # If not bot then continue
    if message.author != client.user:

        print(message.author,'|', string)

        # If starts with prefix then continue
        if command.startswith('£'):
            # Split input from whitespace
            argTest = command.split()
            # Commands with no arguments
            if len(argTest) == (1):
                if command == ('£ping'):
                    await client.send_message(message.channel, 'Pong!')
                    return

                else:
                    await client.send_message(message.channel, 'Not a command :(')
                    return
            
            # Commands with one argument
            if len(argTest) == (2):
                username = ""
                # Rank
                if argTest[0] == ('£rank'):
                    username = argTest[1]
                    print(str(username)+"one arg")
                    req = 'https://osu.ppy.sh/api/get_user?u=' + str(username) + '&k=' + str(apiKey)
                    with urllib.request.urlopen(req) as url:
                        responseUrl = url.read()
                    decodedResponse = json.loads(responseUrl)
                    await client.send_message(message.channel, "#" + str(decodedResponse[0]['pp_rank']))
                    return
                # PP
                if argTest[0] == ('£pp'):
                    username = argTest[1]
                    print(str(username)+"one arg")
                    req = 'https://osu.ppy.sh/api/get_user?u=' + str(username) + '&k=' + str(apiKey)
                    with urllib.request.urlopen(req) as url:
                        responseUrl = url.read()
                    decodedResponse = json.loads(responseUrl)
                    await client.send_message(message.channel, decodedResponse[0]['pp_raw'])
                    return
                # Total
                if argTest[0] == ('£total'):
                    username = argTest[1]
                    print(str(username)+"one arg")
                    req = 'https://osu.ppy.sh/api/get_user?u=' + str(username) + '&k=' + str(apiKey)
                    with urllib.request.urlopen(req) as url:
                        responseUrl = url.read()
                    decodedResponse = json.loads(responseUrl)
                    await client.send_message(message.channel, "#" + str(decodedResponse[0]['pp_rank']) + " | " + str(decodedResponse[0]['pp_raw']) + "pp")
                    return

            # Commands with two or more arguments
            if len(argTest) > (2):
                username = ""
                # Rank
                if argTest[0] == ('£rank'):
                    for x in argTest[1:]:
                        username += str(x) + " "
                    username = username[:-1]
                    print(str(username)+"two arg")
                    req = 'https://osu.ppy.sh/api/get_user?u=' + str(username) + '&k=' + str(apiKey)
                    with urllib.request.urlopen(req) as url:
                        responseUrl = url.read()
                    decodedResponse = json.loads(responseUrl)
                    await client.send_message(message.channel, "#" + str(decodedResponse[0]['pp_rank']))
                    return
                # PP
                if argTest[0] == ('£pp'):
                    for x in argTest[1:]:
                        username += str(x) + " "
                    username = username[:-1]
                    print(str(username)+"two arg")
                    req = 'https://osu.ppy.sh/api/get_user?u=' + str(username) + '&k=' + str(apiKey)
                    with urllib.request.urlopen(req) as url:
                        responseUrl = url.read()
                    decodedResponse = json.loads(responseUrl)
                    await client.send_message(message.channel, decodedResponse[0]['pp_raw'])
                    return
                # Total
                if argTest[0] == ('£total'):
                    for x in argTest[1:]:
                        username += str(x) + " "
                    username = username[:-1]
                    print(str(username)+"two arg")
                    req = 'https://osu.ppy.sh/api/get_user?u=' + str(username) + '&k=' + str(apiKey)
                    with urllib.request.urlopen(req) as url:
                        responseUrl = url.read()
                    decodedResponse = json.loads(responseUrl)
                    await client.send_message(message.channel, "#" + str(decodedResponse[0]['pp_rank']) + " | " + str(decodedResponse[0]['pp_raw']) + "pp")
                    return

            else:
                await client.send_message(message.channel, 'Not a command :(')
                return
    else:
        return

@client.event
async def on_ready():
    print('Logged in as')
    print(client.user.name, client.user.id)
    print('------')

client.run(TOKEN)
