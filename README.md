# perma.cc-link-checker
Uses the Perma.cc API to make sure your references are using the right  perma.cc links.

[Perma.cc](https://perma.cc) creates a stable, persistent page for any link you give it. By using the Perma link instead of the original link, your readers are guaranteed to see the page as it looked when you had Perma.cc create the link. The Perma link takes the reader to a page at Perma.cc that displays an archived copy of the page, and a screen capture of it. A link to the original is of course also supplied. Perma.cc is free to all parties, and is ad-free. It is maintained by the Harvard Law Library and dozens of other libraries.

I had Perma generate several hundred links for a book I have coming out. Over the course of time, I managed to mix up some of the links and references in my text. So I used the Perma.cc API to write a simple script that loops through a list of the Perma links and the titles of the posts (not the \<title> element but the \<h1> or equivalent) my book associates with them. For each reference, the script prints out the Perma link, what it thinks the title is, and the title in my list. Because there can be purposeful differences between the two titles, I then used this one crazy superpower we humans have: I looked at the list to notice meaningful discrepancies.
  
This program is designed for use on publicly available Perma links, not ones you've declared as private. To check the latter, you'd have to supply your Perma API key and change the API call. You can read about that in the [documentation for the API](https://perma.cc/docs/developer)
  
 **NOTE**: I am a hobbyist programmer with primitive skills. This script worked for me, but it is the opposite of robust. It's available under the MIT open license, but that it _may_ be used does not mean that it _should_ be used. -- David Weinberger
  
  ## Use
  
 Create a plain text list of the titles you've used in your document and the Perma link you think is associated with that page, one per line per reference. A typical line might look like this:
  
>You Won't Believe This One Trick Can Save You So Much Money   https://perma.cc/123A-456B

Note that you don't need quotes around the title or any special delimiter between the title and the link; the script assumes anything up to the https:// is the title.

Save your file as "links-and-titles.txt". Or you can create whatever name you like so long as you modify line 15. Put it in the same directory as the PHP script.

To run the script, load the .php page into your browser.

If it runs into a problem with a particular line in yourr file, it will report simply that it has hit a snag. It will suggest that this might be because your file is private, not public.

The script is written in PHP because I'm a pathetic old man. 
