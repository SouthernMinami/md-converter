# python3 file-converter.py markdown inputfile outputfile

import markdown
import sys

contents = ""
html = ""
input_path = sys.argv[2]
output_path = sys.argv[3]

# write markdown in md file
# write md's text converted to html in html file

with open(input_path) as f:
    contents = f.read()
    html = markdown.markdown(contents)

with open(output_path, "w") as f:
    f.write(html)
