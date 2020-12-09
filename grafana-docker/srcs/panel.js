{
	"dashboard":

	{
		"annotations": {
			"list": [
				{
					"builtIn": 1,
					"datasource": "-- Grafana --",
					"enable": true,
					"hide": true,
					"iconColor": "rgba(0, 211, 255, 1)",
					"name": "Annotations & Alerts",
					"type": "dashboard"
				}
			]
		},
		"editable": true,
		"gnetId": null,
		"graphTooltip": 0,
		"id": null,
		"links": [],
		"panels": [
			{
				"aliasColors": {},
				"bars": false,
				"dashLength": 10,
				"dashes": false,
				"datasource": "InfluxDB-1",
				"fieldConfig": {
					"defaults": {
						"custom": {}
					},
					"overrides": []
				},
				"fill": 1,
				"fillGradient": 0,
				"gridPos": {
					"h": 9,
					"w": 12,
					"x": 0,
					"y": 0
					1 more line; after #9  33 seconds ago
					"yaxes": [
						{
							"format": "short",
							"label": null,
							"logBase": 1,
							"max": null,
							"min": null,
							"show": true
						},
						{
							"format": "short",
							"label": null,
							"logBase": 1,
							"max": null,
							"min": null,
							"show": true
						}
					],
					"yaxis": {
						"align": false,
						"alignLevel": null
					}
				}
		],
				"refresh": "5s",
				"schemaVersion": 26,
				"style": "dark",
				"tags": [],
				"templating": {
					"list": []
				},
				"time": {
					"from": "now-5m",
					"to": "now"
				},
				"timepicker": {},
				"timezone": "",
				"title": "New dashboard",
				"uid": null,
				"version": 0
			}
}
