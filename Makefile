curl-test-login:
	curl -d '{"data":{"type": "users", "attributes":{"username":"dummy_test", "password":"password"}}}' -H "Accept: application/vnd.api+json" -H "Content-Type: application/vnd.api+json" http://localhost/api/v1/users/login | json_pp

curl-show-users:
	curl -H "Accept: application/vnd.api+json" -H "Content-Type: application/vnd.api+json" -H "Authorization: Bearer 3|jl7zWlzWqQoOJ63iIbkMbB7SuMPeFrNVb3DcP6oI" http://localhost/api/v1/users/ | json_pp