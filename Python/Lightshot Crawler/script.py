import subprocess
import string
import random
import time

# Chrome directory
chrome_path = 'C:\Program Files (x86)\Google\Chrome\Application\chrome.exe'



def id_generator(size=6, chars=string.ascii_lowercase + string.digits):
    return ''.join(random.choice(chars) for _ in range(size))

while(1==1):
    time.sleep(2)
    url = 'https://prnt.sc/' + id_generator()
    subprocess.Popen("start chrome /new-tab " + url,shell = True)
