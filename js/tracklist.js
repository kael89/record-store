$(function() {
    var tracklist = new Tracklist('tracklist');
    console.log(tracklist.tracks);
});

// Track object
class Track {
    constructor(id) {
        this.$track = $('#' + id);
        this.fetchInfo();
    }

    fetchInfo() {
        this.fetchPosition();
        this.fetchTitle();
        this.fetchDuration();
    }

    fetchPosition() {
        this.position = parseInt(this.$track.find('#trackPosition').text());
    }

    fetchTitle() {
        this.title = this.$track.find('#trackTitle').text();
    }

    fetchDuration() {
        this.druration = this.$track.find('#trackDuration').text();
    }
}

// Tracklist object
// tracks: array of Track objects
class Tracklist {
    constructor(tracklistId) {
        var tracks = {};
        $('#' + tracklistId).find('[id^="tracks-"]').each(function() {
            var id = $(this).attr('id');
            var track = new Track(id);
            track.status = '';
            tracks[id] = track;
        });

        this.tracks = tracks;
    }

    add(trackId) {
        var track = new Track(trackId);
        track.status = 'added';
        tracks[id] = track;
    }

    update(trackId) {
        tracks[trackId].fetchInfo();
        this.status = 'updated';
    }

    delete(trackId) {
        this.status = 'deleted';
    }
}