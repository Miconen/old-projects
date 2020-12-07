from pytube import YouTube

class Downloader:
    def __init__(self, url, folder):
        self.url = str(url)
        self.folder = str(folder)
    def download(self):
        video = YouTube(url)\
        .streams\
        .filter(only_audio=True)\
        .first()
        print(video)
        #video.download(folder)
folder = r'C:\Users\micor\Documents\Hiekkalaatikko\py'
url = r'https://www.youtube.com/watch?v=xFIOqzkQkjc'
video = Downloader(url, folder)
video.download()
