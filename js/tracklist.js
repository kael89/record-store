class Track {
    constructor(id) {
        this.$track = $('#' + id);
        this.fetchData();
        this.resetStatus();
        this.updateControl();
        this.removeControl();
    }

    fetchData() {
        this.position = parseInt(this.$track.find('#trackPosition').text());
        this.artistId = parseInt(this.$track.find('#trackArtistId').text());
        this.title = this.$track.find('#trackTitle').text();
        this.duration = this.$track.find('#trackDuration').text();
    }

    getData() {
        var data = {
            id: this.$track.attr('id'),
            artistId: this.artistId,
            position: this.position,
            title: this.title,
            duration: this.duration,
            status: this.status
        }

        return data;
    }

    resetStatus() {
        this.status = '';
    }

    insert() {
        this.status = 'added';
    }

    update() {
        this.fetchData();
        // Do not change status of newly added or removed tracks
        if (this.status === '') {
            this.status = 'updated';
        }
    }

    remove() {
        this.status = 'removed';
    }

    updateControl() {
        var self = this;
        this.$track.on('update', function() {
            self.update();
        });
    }

    removeControl() {
        var self = this;
        this.$track.on('remove', function() {
            self.remove();
        });
    }
}

// tracks: array of Track objects
class Tracklist {
    constructor(tracklistId) {
        this.tracks = {};

        var self = this;
        $('#' + tracklistId).find('[id^="tracks-"]').each(function() {
            var id = $(this).attr('id');
            if (id.indexOf('new') != -1) {
                // skip to the next iteration of $.each()
                return true;
            }
            var track = new Track(id);
            self.tracks[id] = track;
        });
    }

    insertTrack(trackId) {
        var track = new Track(trackId);
        track.insert();
        this.tracks[trackId] = track;
    }

    update() {
        Object.values(this.tracks).forEach(function(track) {
            track.update();
        });
    }

    fetchArtist() {
        var artistId = getSelected('#artistId');
        Object.values(this.tracks).forEach(function(track) {
            track.artistId = artistId;
        });
    }

    getTrackData() {
        var trackData = [];
        Object.values(this.tracks).forEach(function(track) {
            trackData.push(track.getData());
        });

        return trackData;
    }
}