import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Feed {
  id: number;
  name: string;
  homepage: string;
  delay?: number;
  active?: boolean;
  last_update?: string;
}

@Injectable({ providedIn: 'root' })
export class FeedService {
  private apiUrl = '/'; // Adjust if API is served elsewhere

  constructor(private http: HttpClient) {}

  getFeeds(): Observable<Feed[]> {
    return this.http.get<Feed[]>(`${this.apiUrl}/feeds`);
  }

  addFeed(feed: { name: string; homepage: string }): Observable<any> {
    return this.http.post(`${this.apiUrl}/feeds`, feed);
  }

  deleteFeed(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/feed/${id}`);
  }

  updateFeed(id: number, data: Partial<Feed>): Observable<any> {
    return this.http.patch(`${this.apiUrl}/feed/${id}`, data);
  }
}
