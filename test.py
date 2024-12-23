class StatusBar:
    def __init__(self, time, battery_icon, network_bars, wifi_connected):
        self.time = time
        self.battery_icon = battery_icon  # e.g., "full", "medium", "low"
        self.network_bars = network_bars  # Number of bars (0-5)
        self.wifi_connected = wifi_connected  # True or False

    def parse_status(self):
        battery_percentage = self.get_battery_percentage()
        network_strength = self.get_network_strength()
        wifi_status = "Connected" if self.wifi_connected else "Not Connected"

        return {
            "Time": self.time,
            "Battery Percentage": battery_percentage,
            "Network Strength": network_strength,
            "Wi-Fi Status": wifi_status
        }

    def get_battery_percentage(self):
        # Simulate battery percentage based on icon status
        if self.battery_icon == "full":
            return 100
        elif self.battery_icon == "medium":
            return 50
        elif self.battery_icon == "low":
            return 20
        else:
            return 0

    def get_network_strength(self):
        # Simulate network strength based on the number of bars
        return f"{self.network_bars}/5 bars"

# Example usage
status_bar = StatusBar(time="09:41", battery_icon="medium", network_bars=4, wifi_connected=True)
parsed_data = status_bar.parse_status()

# Display the parsed data
for key, value in parsed_data.items():
    print(f"{key}: {value}")