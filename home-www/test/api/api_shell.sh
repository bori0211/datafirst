#!/bin/sh
echo 
echo 
curl -X GET "https://api.pubg.com/status" -H "accept: application/vnd.api+json"

echo 
echo 
curl -X GET "https://api.pubg.com/shards/pc-na/players?filter\[playerNames\]=shroud" \
-H "accept: application/vnd.api+json" \
-H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiIwZjI0OGY5MC0xZjRlLTAxMzYtZDM4ZC0xNzMzY2RiZDdjNGYiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTIzNDA2ODg2LCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6ImJvcmkwMjExIn0.ELGg5QcA1ksdpXwwu4IAjOd-H4TeaabNM_yvUvtDl9E"

echo 
echo 
