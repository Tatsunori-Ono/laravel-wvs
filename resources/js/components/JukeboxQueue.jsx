import React, { useState, useEffect } from 'react';
import axios from 'axios';

const JukeboxQueue = () => {
  const [queue, setQueue] = useState([]);
  const [currentlyPlaying, setCurrentlyPlaying] = useState(null);

  useEffect(() => {
    fetchQueue();
    const interval = setInterval(fetchQueue, 5000);
    return () => clearInterval(interval);
  }, []);

  const fetchQueue = async () => {
    try {
      const response = await axios.get('/queue');
      setQueue(response.data);
      setCurrentlyPlaying(response.data.find(video => video.status === 'playing'));
    } catch (error) {
      console.error('Error fetching the queue', error);
    }
  };

  const extractVideoId = (url) => {
    const urlObj = new URL(url);
    return urlObj.searchParams.get("v");
  };

  return (
    <div>
      <h1>Video Queue</h1>
      <ul>
        {queue.map(video => (
          <li key={video.id}>
            {video.video_title} - {video.video_length}s (Added by: {video.user.name})
          </li>
        ))}
      </ul>
      {currentlyPlaying && (
        <div>
          <h2>Now Playing: {currentlyPlaying.video_title}</h2>
          <iframe
            src={`https://www.youtube.com/embed/${extractVideoId(currentlyPlaying.video_url)}`}
            frameBorder="0"
            allow="autoplay; encrypted-media"
            allowFullScreen
            title="Currently Playing"
          ></iframe>
        </div>
      )}
    </div>
  );
};

export default JukeboxQueue;
