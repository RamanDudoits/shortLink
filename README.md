<h1 align="center">Hi there, this is generate short links project <img src="https://github.com/blackcater/blackcater/raw/main/images/Hi.gif" height="32"/></h1>

## Capabilities <g-emoji class="g-emoji" alias="golf" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/26f3.png">⛳️</g-emoji>

- **𝘛𝘩𝘪𝘴 𝘱𝘳𝘰𝘫𝘦𝘤𝘵 𝘩𝘢𝘴 𝘶𝘴𝘦𝘳 𝘳𝘦𝘨𝘪𝘴𝘵𝘳𝘢𝘵𝘪𝘰𝘯.**
- **𝘌𝘢𝘤𝘩 𝘶𝘴𝘦𝘳 𝘩𝘢𝘴 𝘵𝘩𝘦𝘪𝘳 𝘰𝘸𝘯 𝘭𝘪𝘯𝘬𝘴 𝘢𝘯𝘥 𝘭𝘪𝘯𝘬𝘴 𝘰𝘧 𝘰𝘵𝘩𝘦𝘳 𝘶𝘴𝘦𝘳𝘴 𝘪𝘧 𝘵𝘩𝘦𝘺 𝘢𝘳𝘦 𝘵𝘩𝘦 𝘴𝘢𝘮𝘦**

## How this to work <g-emoji class="g-emoji" alias="hammer_and_wrench" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/1f6e0.png">🛠</g-emoji>

The user registers and then sees a form for receiving short links.
After entering the link in the link field, an ajax request is made to the server where the form is validated using <img src="https://raw.githubusercontent.com/simple-icons/simple-icons/develop/icons/laravel.svg#gh-light-mode-only" alt="Laravel" align="left" width="24" height="24" style="max-width: 100%;"> laravel. 
After receiving a positive response from the server, the user sees a table with their links. 
To prevent duplication of links, linking the user's tables with the link table is implemented through the many-to-many pattern.

