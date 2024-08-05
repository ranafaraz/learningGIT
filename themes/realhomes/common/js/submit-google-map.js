/**
 * Javascript to handle google map for property submit page
 */
(function ($) {
  "use strict";

  $(document).ready(function () {
    var mapField = {};

    (function () {
      var thisMapField = this;

      this.container = null;
      this.canvas = null;
      this.position = {};
      this.map = null;
      this.marker = null;
      this.geocoder = null;
      this.autocomplete = null;
      this.query = "כלנית 24";
      this.queryPrefix = "חריש,";

      this.init = function ($container) {
        this.container = $container;
        this.canvas = $container.find(".map-canvas");
        this.initLatLng(32.4546012878418, 35.0515251159668);
        this.updateMap();
        this.initAutoComplete();
      };

      this.initLatLng = function ($lat, $lng) {
        this.position = { lat: $lat, lng: $lng };
      };

      this.updateMap = function () {
        const API_KEY = "AIzaSyCa7WK1x4jTUzP1X6mnzJfC1ggUBzEdfWQ";

        const iframe = document.createElement("iframe");
        iframe.src = `//www.google.com/maps/embed/v1/place?key=${API_KEY}&q=${encodeURIComponent(
          `${this.queryPrefix}${this.query}`
        )}&zoom=17&language=he&region=il`;
        iframe.width = "100%";
        iframe.height = "100%";
        iframe.style.border = "0";
        iframe.style.height = "calc(100% - 9rem)";
        iframe.allowFullscreen = false;
        iframe.loading = "lazy";
        iframe.referrerPolicy = "no-referrer-when-downgrade";

        const mapCanvas = document.querySelector(".map-canvas");
        mapCanvas.innerHTML = "";
        mapCanvas.appendChild(iframe);
      };

      this.initMarker = function () {
        // this.marker = new window.google.maps.Marker({position: this.latlng, map: this.map, draggable: true});
        this.marker = new window.google.maps.marker.AdvancedMarkerElement({
          position: this.latlng,
          map: this.map,
          draggable: true,
        });
      };

      this.initMarkerPosition = function () {
        var coord = this.container.find(".map-coordinate").val();
        var addressField = this.container.find(".goto-address-button").val();
        var l;
        var zoom;

        if (coord) {
          l = coord.split(",");
          //   this.marker.setPosition(new window.google.maps.LatLng(l[0], l[1]));
          this.marker.position = new google.maps.LatLng(l[0], l[1]);

          zoom = l.length > 2 ? parseInt(l[2], 10) : 15;

          this.map.setCenter(this.marker.position);
          this.map.setZoom(zoom);
        } else if (addressField) {
          this.geocodeAddress(addressField);
        }
      };

      this.initGeocoder = function () {
        this.geocoder = new window.google.maps.Geocoder();
      };

      this.initListeners = function () {
        var that = thisMapField;
        window.google.maps.event.addListener(
          this.map,
          "click",
          function (event) {
            that.marker.setPosition(event.latLng);
            that.updatePositionInput(event.latLng);
          }
        );
        window.google.maps.event.addListener(
          this.marker,
          "drag",
          function (event) {
            that.updatePositionInput(event.latLng);
          }
        );
      };

      this.updatePositionInput = function (latLng) {
        this.container
          .find(".map-coordinate")
          .val(latLng.lat() + "," + latLng.lng());
      };

      this.geocodeAddress = function (addressField) {
        var address = "";
        var fieldList = addressField.split(",");
        var loop;

        for (loop = 0; loop < fieldList.length; loop++) {
          address += jQuery("#" + fieldList[loop]).val();
          if (loop + 1 < fieldList.length) {
            address += ", ";
          }
        }

        address = address.replace(/\n/g, ",");
        address = address.replace(/,,/g, ",");

        var that = thisMapField;
        if (/[a-z]/i.test(address)) {
          this.geocoder.geocode(
            { address: address },
            function (results, status) {
              if (status === window.google.maps.GeocoderStatus.OK) {
                that.updatePositionInput(results[0].geometry.location);
                that.marker.setPosition(results[0].geometry.location);
                that.map.setCenter(that.marker.position);
                that.map.setZoom(15);
              }
            }
          );
        } else {
          const latLngStr = address.split(",", 2),
            newLatLang = new window.google.maps.LatLng(
              latLngStr[0],
              latLngStr[1]
            );
          this.geocoder.geocode(
            { latLng: newLatLang },
            function (results, status) {
              if (status === google.maps.GeocoderStatus.OK) {
                that.updatePositionInput(newLatLang);
                that.marker.setPosition(newLatLang);
                that.map.setCenter(that.marker.position);
                that.map.setZoom(15);

                document.getElementById("address").value =
                  results[0].formatted_address;
              }
            }
          );
        }
      };

      this.initAutoComplete = function () {
        // Add an event listener to the address field to update the full address field
        document.querySelector("#address").addEventListener("input", (e) => {
          if (!e.target.value || e.target.value.trim().length === 0) {
            document.getElementById("full-address").value = "";
            document.querySelector(".pac-container").style.display = "none";
            return;
          }

          document.getElementById("full-address").value = `${
            this.queryPrefix
          }${e.target.value.trim()}`;

          // Trigger events to update the dropdown
          document.getElementById("full-address").focus();
          document.getElementById("full-address").blur();
          document
            .getElementById("full-address")
            .dispatchEvent(new Event("change"));
          document
            .getElementById("full-address")
            .dispatchEvent(new Event("input"));
          document.getElementById("full-address").click();

          // Get back to the address field
          document.getElementById("address").focus();

          // Add listener for dom changes .pac-container
          const targetNode = document.querySelector(".pac-container");

          // Options for the observer (which mutations to observe)
          const config = { childList: true, subtree: true };
          // Callback function to execute when mutations are observed
          const callback = (mutationsList, observer) => {
            for (let mutation of mutationsList) {
              if (mutation.type === "childList") {
                mutation.addedNodes.forEach((node) => {
                  if (
                    node.nodeType === Node.ELEMENT_NODE &&
                    node.classList.contains("pac-item")
                  ) {
                    node.addEventListener("click", () => {
                      const place =
                        node.querySelector(".pac-item-query").textContent;

                      this.query = place;
                      document.getElementById("full-address").value =
                        this.query;
                      document.getElementById("address").value = place;
                      this.updateMap();

                      // Close the dropdown
                      document.querySelector(".pac-container").style.display =
                        "none";
                    });
                  }
                });
              }
            }
          };

          // Create an observer instance linked to the callback function
          const observer = new MutationObserver(callback);

          // Start observing the target node for configured mutations
          observer.observe(targetNode, config);
        });

        this.autocomplete = new google.maps.places.Autocomplete(
          document.getElementById("full-address"),
          { types: ["geocode"], componentRestrictions: { country: "il" } }
        );

        this.autocomplete.addListener("place_changed", () =>
          this.onPlaceChanged()
        );
      };

      this.onPlaceChanged = function () {
        const place = this.autocomplete.getPlace();
        this.query = place.formatted_address;
        document.getElementById("full-address").value = this.query;
        this.updateMap();

        // Format and set the address without the country name
        const formattedAddress = this.formatAddress(place.address_components);
        document.getElementById("address").value = formattedAddress;
      };

      this.formatAddress = function (addressComponents) {
        let street = "";
        let streetNumber = "";
        let buildingNumber = "";

        for (let component of addressComponents) {
          if (component.types.includes("route")) {
            street = component.long_name;
          } else if (component.types.includes("street_number")) {
            streetNumber = component.long_name;
          } else if (component.types.includes("subpremise")) {
            buildingNumber = component.long_name;
          }
        }

        return `${street} ${streetNumber}${
          buildingNumber ? `, ${buildingNumber}` : ""
        }`;
      };

      this.bindHandlers = function () {
        var that = thisMapField;
        this.container.find(".goto-address-button").bind("click", function () {
          that.onFindAddressClick($(this));
        });
      };

      this.onFindAddressClick = function ($that) {
        var $this = $that;
        this.geocodeAddress($this.val());
      };
    }).apply(mapField);

    $(".map-wrapper").each(function () {
      mapField.init($(this));
    });
  });
})(jQuery);
