import os

basePath = 'C:\\Users'

folderholder = {}

class Folder:
    def __init__(self, path, filename, parent, depth):
        self.path = path
        self.filename = filename
        self.parent = parent
        self.depth = depth

        self.loopSelf()

    def loopSelf(self):
        for filename in os.listdir(self.path):

            if os.path.isfile(f'{self.path}\\{filename}'):
                self.outputFile(filename)

            if os.path.isdir(f'{self.path}\\{filename}'):
                self.outputFolder(filename)
                if bool(folderholder.get(filename)) == False:
                    folderholder[filename] = Folder(self.path + '\\' + filename, filename, self.filename, self.depth + 4)
                else:
                    return print('error')

    def outputFile(self, filename):
        print(self.indenter(filename))

    def outputFolder(self, filename):
        print(self.indenter('# ' + filename))

    def indenter(self, input):
        i = 0
        indentation = ''
        while i < self.depth:
            indentation += ' '
            i += 1
        return indentation + input;

folderholder[os.path.basename(basePath)] = Folder(basePath, os.path.basename(basePath), False, 0)
