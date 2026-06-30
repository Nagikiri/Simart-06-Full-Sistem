const fs = require('fs');

const rawHtmlTemplate1 = fs.readFileSync('all_templates_utf8.txt', 'utf8');

const regex = /\(\s*(?:&emsp;|&nbsp;|\.|_|\s|&#160;|<sup[^>]*>.*?<\/sup>){1,}\s*\)/ig;

const matches = rawHtmlTemplate1.match(regex);
console.log("Matches:", matches);
