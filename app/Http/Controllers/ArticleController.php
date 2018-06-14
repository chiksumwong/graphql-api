<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function show(Article $article)
    {
        //remove 'data' wrapper
        ArticleResource::withoutWrapping();
        return new ArticleResource($article);
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}

// HTTP State
// 200：OK，標準的響應成功狀態碼
// 201：創建對象，用於存儲操作
// 204：沒有內容，操作執行成功，但是沒有返回任何內容
// 206：部分內容，返回部分資源時使用
// 400：錯誤的請求，請求驗證失敗
// 401：未經授權，用戶需要認證
// 403：禁止，用戶認證通過但是沒有權限執行該操作
// 404：找不到，請求資源不存在
// 500：內部服務器錯誤，通常我們並不會顯示返回這個狀態碼，除非程序異常中斷
// 503：服務不可用，一般也不會顯示返回，通常用於排查問題用
