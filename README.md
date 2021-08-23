# OpenTok Getting Started Sample App

<img src="https://assets.tokbox.com/img/vonage/Vonage_VideoAPI_black.svg" height="48px" alt="Tokbox is now known as Vonage" />

A simple server that uses the [Vonage PHP Video SDK](https://github.com/Vonage/vonage-php-sdk-video)
to create Vonage Video API sessions and generate tokens for those sessions, using Vonage API credentials
(a Vonage application ID and private key).

## Requirements

- [Composer](https://getcomposer.org/)
- [PHP 7.3 or higher](https://php.net)

## Installation & Running on localhost

  1. Clone the app by running the command
  
          git clone git@github.com:opentok/learning-opentok-php.git

  2. `cd` to the root directory.

  3. Run `composer install` command to fetch and install all dependencies.

  4. Next, copy the `.env.dist` file to `.env` and edit to add your API Key and Secret:

      ```
      VONAGE_APPLICATION_ID=0000000
      VONAGE_PRIVATE_KEY=000000
      ```

      Also, if you need to set a test API URL, set the `VONAGE_VIDEO_API_SERVER_URL` environment variable:
      
      ```
      export VONAGE_VIDEO_API_SERVER_URL=https://api.dev.opentok.com
      ```

   5. Start the server using composer:

    `$ composer run --timeout 0 serve`

  6. Visit the URL <http://localhost:3000/room/roomName> in your browser. (Replace `roomName` with a unique
     room name. You should see a JSON response containing the OpenTok API key, session ID, and token.

  7. Visit the URL <http://localhost:3000/room/roomName/join> in your browser. You should see a page with
     a test Video API session with a Video API publisher video. Open the page in another browser.
     You should see a page with a publisher and subscriber video.
     
     * Click the *Start Archive* button to start recording the session.

     * Click the *Stop Archive* button to stop recording the session.

     * Click the *View archive info* button to view details about the archive.

     * Click the *View archive* button to view the archive recording.

     * Click the *Send signal from server* button to have the server send a signal to the session.
