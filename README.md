# FFmpeg-Library
FFMPEG library, available to anyone.

This library is create for personal use, but if you want to use it feel free to use it :) .
To use it you will need to go deeper and see what the functions are doign, since it is a personal use i am not going to document everything

### How To use

First you need all of the libraries to use it 

```
use FFMpegLib\Initializer;
use FFMpegLib\Executor\Executor;
use FFMpegLib\Commands\VideoDurationCommand;
use FFMpegLib\Commands\CreateImagesCommand;
use FFMpegLib\Commands\GifCommand;
use FFMpegLib\FileFinder\FileFinder;
```

Then you need to initalize it

```
Initializer::initializeFFMpeg();
```

You can get video duration with

```
$videoDurationCommand = new VideoDurationCommand('video.flv', APP_PATH);

Executor::executeCommand($videoDurationCommand);

$videoDurationCommand->getDuration(); // it returns an instance of Time
```

To create images suitable for gif:

```
$imagesPath = APP_PATH . '/assets/images/image.png';
$videoPath = APP_PATH . '/assets/videos/video.flv';

$createImagesCommand = new CreateImagesCommand(
	$videoPath, 
	$imagesPath, 
	'00:30:40', 
	'00:0:03', 
	$videoDurationCommand->getDuration());

Executor::executeCommand($createImagesCommand);
```

Take note you need to delete the images yourself as the option is not yet implemented


You can create a gif with:
```
$gifCommand = new GifCommand(APP_PATH . '/assets/images/image.png', APP_PATH . '/assets/images/t.gif');
Executor::executeCommand($gifCommand);
```

You need to specify the full path of the video for every command except for the duration, there i use a finder for the base path, but you can pass the full path as well.

to get the images/frames created from createImagesCommand use 
```
$createImagesCommand->framesCreated();
```

The time Class

methods:
```
getSeconds(); //returns seconds, you need a Time object to call all of theese methods
getMinutes();
getHours();
getFullTime();
getTimeInSeconds();
getTimeInMinutes();
create();// static method -- Time::create()
createFromString(); // static method -- Time::createFromString()
```