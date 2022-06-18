# Database Setup

The database table schemas can be found below for anyone who is editing the site
to reference.


## Chapter
| Column Name   | Description                                               | Type              |
|---------------|-----------------------------------------------------------|-------------------|
| id            | For internal use -- the chapter's identifier              | INT               |
| manga\_id     | For internal use -- the manga's identifier                | INT               |
| title         | The chapter title                                         | TEXT              |
| path          | The path to the chapter's content                         | TEXT              |
| number        | The chapter number                                        | DOUBLE            |
| release\_date | The date the chapter was released                         | TEXT (MM-DD-YYYY) |
| local         | Whether or not there is a local copy available.           | BOOLEAN           |
| twitter       | Link to the chapter on twitter, NULL if none exists       | TEXT              |
| dynasty       | Link to the chapter on dynasty-scans, NULL if none exists | TEXT              |
| mangadex      | Link to the chapter on mangadex, NULL if none exists      | TEXT              |
| credits       | The chapter's scanlator credits.                          |                   |


## Author
| Column Name    | Description                                          | Type    |
|----------------|------------------------------------------------------|---------|
| id             | For internal use -- the author's identifier          | INT     |
| name           | The author's name in romanji                         | TEXT    |
| japanese\_name | The author's name in kanji/hirigana/katakana         | TEXT    |
| twitter        | A link to the author's twitter, empty if none exists | TEXT    |
| pixiv          | A link to the author's pixiv, empty if none exists   | TEXT    |
| description    | A short "bio" about the author.                      | TEXT    |
| is\_nsfw       | Whether or not the author produces NSFW art          | BOOLEAN |
| avatar_link    | The filename of the author's avatar                  | TEXT    |


## Manga 
| Column Name     | Description                                   | Type    |
|-----------------|-----------------------------------------------|---------|
| id              | For internal use -- the manga's identifier    | INT     |
| title           | The English title of the manga                | TEXT    |
| japanese\_title | The Japanese title of the manga               | TEXT    |
| author\__id     | For internal use -- the author's identifier   | INT     |
| image\_link     | The filename of the cover image for the manga | TEXT    |
| num\_chapters   | The total number of chapters in the manga.    | INT     |
| is\_oneshot     | Whether or not manga is a oneshot             | BOOLEAN |
